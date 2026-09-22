# Benchmarks

Compares `xefi/faker-php` with `fakerphp/faker` on install footprint, boot time, throughput and
`unique()` cost. Both libraries are installed from Packagist, so the numbers describe what a user
actually gets, not this working tree.

## Run

From the repository root, with Docker running:

```bash
docker build -t faker-bench benchmarks
docker run --rm -v "$PWD/benchmarks/results:/bench/results" faker-bench
```

The report is printed and written to `benchmarks/results/results.md`, with the aggregated data in
`results.json` and every raw measurement in `raw/`.

## Method

- **Environment**: `php:8.4-cli`, OPcache off (the CLI default), latest Composer 2.
- **Footprint**: size of `vendor/` after `composer require --update-no-dev`, minus the size of an
  empty project's `vendor/` (Composer's own autoloader). "Package alone" is the library directory
  without its dependencies.
- **Boot**: wall time from process start to the first generated value, autoload included, median of
  21 fresh processes. `xefi/faker-php` caches its provider and IDE manifests next to `vendor/`, so it
  is measured twice: with the manifests deleted before every run, and with them already built.
- **Throughput**: calls per second on the same `Faker` instance, median of five rounds of 5,000 calls
  after 500 warmup calls.
- **`unique()`**: time to draw N unique integers between 1 and 1,000,000, for N = 1,000, 5,000 and
  20,000.

Equivalent generators:

| | `xefi/faker-php` | `fakerphp/faker` |
| --- | --- | --- |
| name | `name()` | `name()` |
| email | `email()` | `email()` |
| integer | `number(1, 1000)` | `numberBetween(1, 1000)` |
| text | `sentences(3)` | `sentences(3, true)` |
| uuid | `uuid()` | `uuid()` |
| date | `dateTime()` | `dateTime()` |

`fakerphp/faker` runs with its default `en_US` locale and `xefi/faker-php` with its built-in default
data, so text generators do not draw from identical word lists.

Timings move by roughly ten percent between runs on the same machine; compare orders of magnitude,
and rerun on your own hardware before quoting a number.
