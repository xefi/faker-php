<?php

/**
 * Aggregates the raw measurements written by run.sh into results.json and
 * results.md.
 *
 * Usage: php report.php <results directory>
 */
$directory = rtrim($argv[1] ?? __DIR__.'/results', '/');
$raw = "{$directory}/raw";

function readJson(string $path): array
{
    return json_decode(file_get_contents($path), true, flags: JSON_THROW_ON_ERROR);
}

function median(array $values): float
{
    sort($values);
    $middle = intdiv(count($values), 2);

    return count($values) % 2 ? $values[$middle] : ($values[$middle - 1] + $values[$middle]) / 2;
}

function kilobytes(int $bytes): string
{
    return $bytes >= 1024 * 1024
        ? number_format($bytes / 1024 / 1024, 2).' MB'
        : number_format($bytes / 1024).' kB';
}

function installedVersion(array $footprint, string $package): string
{
    foreach ($footprint['installed']['installed'] as $installed) {
        if ($installed['name'] === $package) {
            return $installed['version'];
        }
    }

    return '?';
}

$environment = readJson("{$raw}/env.json") + ['composer' => trim(file_get_contents("{$raw}/composer.txt"))];

$footprints = [];
foreach (['xefi', 'xefi-fr', 'fakerphp'] as $name) {
    $footprints[$name] = readJson("{$raw}/footprint-{$name}.json");
}

$versions = [
    'xefi/faker-php' => installedVersion($footprints['xefi'], 'xefi/faker-php'),
    'fakerphp/faker' => installedVersion($footprints['fakerphp'], 'fakerphp/faker'),
];

$boot = [];
foreach (['xefi-cold', 'xefi-warm', 'fakerphp'] as $label) {
    $runs = array_map(
        fn ($line) => json_decode($line, true),
        array_filter(file("{$raw}/boot-{$label}.jsonl", FILE_IGNORE_NEW_LINES), 'strlen')
    );

    $boot[$label] = [
        'runs'      => count($runs),
        'median_ms' => round(median(array_column($runs, 'boot_ms')), 1),
        'peak_kb'   => (int) median(array_column($runs, 'peak_kb')),
    ];
}

$throughput = [
    'xefi'     => readJson("{$raw}/throughput-xefi.json"),
    'fakerphp' => readJson("{$raw}/throughput-fakerphp.json"),
];

$unique = [];
foreach (glob("{$raw}/unique-*.json") as $path) {
    preg_match('/unique-(xefi|fakerphp)-(\d+)\.json$/', $path, $match);
    $unique[(int) $match[2]][$match[1]] = readJson($path)['ms'];
}
ksort($unique);

$results = compact('environment', 'versions', 'boot', 'throughput', 'unique') + [
    'footprint' => array_map(fn ($footprint) => array_diff_key($footprint, ['installed' => true]), $footprints),
];

file_put_contents("{$directory}/results.json", json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."\n");

$labels = [
    'xefi'     => '`xefi/faker-php`',
    'xefi-fr'  => '`xefi/faker-php` + `fr-fr` locale',
    'fakerphp' => '`fakerphp/faker`',
];

$markdown = [
    "Measured with `xefi/faker-php` {$versions['xefi/faker-php']} and `fakerphp/faker` {$versions['fakerphp/faker']}",
    "on PHP {$environment['php']} ({$environment['os']}, CLI, OPcache off), {$environment['composer']}.",
    '',
    '### Install footprint',
    '',
    '| Install | Package alone | With dependencies | Packages installed |',
    '| --- | ---: | ---: | ---: |',
];

foreach ($footprints as $name => $footprint) {
    $markdown[] = sprintf(
        '| %s | %s | %s | %d |',
        $labels[$name],
        kilobytes($footprint['package_bytes']),
        kilobytes($footprint['total_bytes']),
        $footprint['packages']
    );
}

$markdown = array_merge($markdown, [
    '',
    '### Boot: process start to first generated value',
    '',
    "Median of {$boot['fakerphp']['runs']} fresh processes, autoload included.",
    '',
    '| | Median | Peak memory |',
    '| --- | ---: | ---: |',
    sprintf('| `xefi/faker-php`, first run (manifests built) | %s ms | %s kB |', $boot['xefi-cold']['median_ms'], number_format($boot['xefi-cold']['peak_kb'])),
    sprintf('| `xefi/faker-php`, next runs (manifests cached) | %s ms | %s kB |', $boot['xefi-warm']['median_ms'], number_format($boot['xefi-warm']['peak_kb'])),
    sprintf('| `fakerphp/faker` | %s ms | %s kB |', $boot['fakerphp']['median_ms'], number_format($boot['fakerphp']['peak_kb'])),
    '',
    '### Throughput',
    '',
    'Calls per second, median of five rounds of 5,000 calls after a warmup. Higher is better.',
    '',
    '| Generator | `xefi/faker-php` | `fakerphp/faker` | Ratio |',
    '| --- | ---: | ---: | ---: |',
]);

foreach ($throughput['xefi'] as $generator => $calls) {
    $markdown[] = sprintf(
        '| %s | %s | %s | %s× |',
        $generator,
        number_format($calls),
        number_format($throughput['fakerphp'][$generator]),
        number_format($calls / $throughput['fakerphp'][$generator], 2)
    );
}

$markdown = array_merge($markdown, [
    '',
    '### `unique()`',
    '',
    'Time to draw N unique integers between 1 and 1,000,000. Lower is better.',
    '',
    '| N | `xefi/faker-php` | `fakerphp/faker` |',
    '| ---: | ---: | ---: |',
]);

foreach ($unique as $count => $timings) {
    $markdown[] = sprintf('| %s | %s ms | %s ms |', number_format($count), $timings['xefi'], $timings['fakerphp']);
}

file_put_contents("{$directory}/results.md", implode("\n", $markdown)."\n");

echo implode("\n", $markdown)."\n";
