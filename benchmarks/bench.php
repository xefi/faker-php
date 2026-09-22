<?php

/**
 * Compares xefi/faker-php with fakerphp/faker on equivalent generators.
 *
 * Usage, from a project where the library is installed:
 *   php bench.php <xefi|fakerphp> boot
 *   php bench.php <xefi|fakerphp> throughput
 *   php bench.php <xefi|fakerphp> unique <count>
 *
 * Every mode prints one JSON object on stdout.
 */
$start = hrtime(true);

require getcwd().'/vendor/autoload.php';

[, $library, $mode] = $argv + [null, null, null];

$generators = [
    'xefi' => [
        'create'  => fn () => new \Xefi\Faker\Faker(),
        'name'    => fn ($faker) => $faker->name(),
        'email'   => fn ($faker) => $faker->email(),
        'integer' => fn ($faker) => $faker->number(1, 1000),
        'text'    => fn ($faker) => $faker->sentences(3),
        'uuid'    => fn ($faker) => $faker->uuid(),
        'date'    => fn ($faker) => $faker->dateTime(),
        'unique'  => fn ($faker) => $faker->unique()->number(1, 1000000),
    ],
    'fakerphp' => [
        'create'  => fn () => \Faker\Factory::create(),
        'name'    => fn ($faker) => $faker->name(),
        'email'   => fn ($faker) => $faker->email(),
        'integer' => fn ($faker) => $faker->numberBetween(1, 1000),
        'text'    => fn ($faker) => $faker->sentences(3, true),
        'uuid'    => fn ($faker) => $faker->uuid(),
        'date'    => fn ($faker) => $faker->dateTime(),
        'unique'  => fn ($faker) => $faker->unique()->numberBetween(1, 1000000),
    ],
];

if (!isset($generators[$library])) {
    fwrite(STDERR, "Unknown library '{$library}', expected xefi or fakerphp.\n");
    exit(1);
}

$library = $generators[$library];

function elapsedMs(int $since): float
{
    return (hrtime(true) - $since) / 1e6;
}

function median(array $values): float
{
    sort($values);
    $middle = intdiv(count($values), 2);

    return count($values) % 2 ? $values[$middle] : ($values[$middle - 1] + $values[$middle]) / 2;
}

switch ($mode) {
    // Time from process start (autoload included) to the first generated value.
    case 'boot':
        $faker = $library['create']();
        $library['name']($faker);

        echo json_encode([
            'boot_ms' => round(elapsedMs($start), 3),
            'peak_kb' => round(memory_get_peak_usage() / 1024),
        ]);
        break;

        // Calls per second for each generator, median of five rounds after a warmup.
    case 'throughput':
        $faker = $library['create']();
        $calls = 5000;
        $results = [];

        foreach (['name', 'email', 'integer', 'text', 'uuid', 'date'] as $generator) {
            for ($i = 0; $i < 500; $i++) {
                $library[$generator]($faker);
            }

            $rounds = [];
            for ($round = 0; $round < 5; $round++) {
                $since = hrtime(true);
                for ($i = 0; $i < $calls; $i++) {
                    $library[$generator]($faker);
                }
                $rounds[] = $calls / (elapsedMs($since) / 1000);
            }

            $results[$generator] = (int) round(median($rounds));
        }

        echo json_encode($results);
        break;

        // Time to draw <count> unique integers out of a million.
    case 'unique':
        $count = (int) ($argv[3] ?? 10000);
        $faker = $library['create']();

        $since = hrtime(true);
        for ($i = 0; $i < $count; $i++) {
            $library['unique']($faker);
        }

        echo json_encode(['count' => $count, 'ms' => round(elapsedMs($since), 1)]);
        break;

    default:
        fwrite(STDERR, "Unknown mode '{$mode}', expected boot, throughput or unique.\n");
        exit(1);
}
