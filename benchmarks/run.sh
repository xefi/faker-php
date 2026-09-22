#!/usr/bin/env bash
# Installs each library from Packagist in its own project, then measures
# footprint, boot time, throughput and unique() cost. Raw measurements land in
# results/raw/, report.php turns them into results/results.{json,md}.
set -euo pipefail

BENCH=/bench
RAW=$BENCH/results/raw
PROJECTS=/tmp/projects
BOOT_RUNS=21

rm -rf "$RAW" "$PROJECTS"
mkdir -p "$RAW" "$PROJECTS"

php -r 'echo json_encode(["php" => PHP_VERSION, "os" => php_uname("s")." ".php_uname("m")]);' > "$RAW/env.json"
composer --version --no-ansi 2>/dev/null | head -1 > "$RAW/composer.txt"

# An empty project gives the size of Composer's own autoload files, which is
# subtracted from every footprint below.
mkdir "$PROJECTS/baseline"
echo '{}' > "$PROJECTS/baseline/composer.json"
composer install -q -d "$PROJECTS/baseline"
BASELINE=$(du -sb "$PROJECTS/baseline/vendor" | cut -f1)

install() {
    local name=$1; shift
    mkdir "$PROJECTS/$name"
    echo '{}' > "$PROJECTS/$name/composer.json"
    composer require -q --update-no-dev --prefer-dist -d "$PROJECTS/$name" "$@"
}

footprint() {
    local name=$1 package=$2 dir=$PROJECTS/$1
    local total package_bytes packages versions

    total=$(( $(du -sb "$dir/vendor" | cut -f1) - BASELINE ))
    package_bytes=$(du -sb "$dir/vendor/$package" | cut -f1)
    packages=$(composer show -d "$dir" --name-only --no-ansi | wc -l)
    versions=$(composer show -d "$dir" --format=json --no-ansi)

    printf '{"name":"%s","total_bytes":%d,"package_bytes":%d,"packages":%d,"installed":%s}\n' \
        "$name" "$total" "$package_bytes" "$packages" "$versions" > "$RAW/footprint-$name.json"
}

boot() {
    local name=$1 library=$2 label=$3 reset=${4:-}
    : > "$RAW/boot-$label.jsonl"

    # xefi/faker-php caches its provider and IDE manifests next to vendor/:
    # "cold" deletes them before every run, "warm" builds them once first.
    if [ "$reset" = warm ]; then
        (cd "$PROJECTS/$name" && php "$BENCH/bench.php" "$library" boot > /dev/null)
    fi

    for _ in $(seq $BOOT_RUNS); do
        if [ "$reset" = cold ]; then
            rm -f "$PROJECTS/$name/packages.php" "$PROJECTS/$name/faker_mixin.php"
        fi
        (cd "$PROJECTS/$name" && php "$BENCH/bench.php" "$library" boot) >> "$RAW/boot-$label.jsonl"
        echo >> "$RAW/boot-$label.jsonl"
    done
}

echo "Installing from Packagist..."
install xefi xefi/faker-php
install xefi-fr xefi/faker-php xefi/faker-php-locales-fr-fr
install fakerphp fakerphp/faker

echo "Measuring footprint..."
footprint xefi xefi/faker-php
footprint xefi-fr xefi/faker-php
footprint fakerphp fakerphp/faker

echo "Measuring boot time ($BOOT_RUNS runs each)..."
boot xefi xefi xefi-cold cold
boot xefi xefi xefi-warm warm
boot fakerphp fakerphp fakerphp

echo "Measuring throughput..."
(cd "$PROJECTS/xefi" && php "$BENCH/bench.php" xefi throughput) > "$RAW/throughput-xefi.json"
(cd "$PROJECTS/fakerphp" && php "$BENCH/bench.php" fakerphp throughput) > "$RAW/throughput-fakerphp.json"

echo "Measuring unique()..."
for count in 1000 5000 20000; do
    (cd "$PROJECTS/xefi" && php "$BENCH/bench.php" xefi unique $count) > "$RAW/unique-xefi-$count.json"
    (cd "$PROJECTS/fakerphp" && php "$BENCH/bench.php" fakerphp unique $count) > "$RAW/unique-fakerphp-$count.json"
done

php "$BENCH/report.php" "$BENCH/results"
