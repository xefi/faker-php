<p align="center"><img src="https://github.com/xefi/art/blob/main/faker-php-landscape.png?raw=true" alt="Social Card of Faker PHP"></p>

# Faker PHP

Faker PHP allows you to easily generate mock data for your tests, providing a quick and flexible way to simulate realistic data effortlessly—perfect for creating robust development and testing environments.

## Requirements

PHP 8.3+

## Documentation, Installation, and Usage Instructions

See the [documentation](https://faker-php.xefi.com) for detailed installation and usage instructions.

## What It Does

You'll be able to generate fake data for your applications, making your test environment more flexible.

Here is a quick look at what you can do:

```php
$faker = new \Xefi\Faker\Faker();

$faker->name() // John Doe
$faker->name() // Charles Brown

$faker->sentences() // Nulla facilisi. Proin nec ante at erat pharetra interdum. Etiam nec ligula felis.

$faker->iban() // PX41711762752955497163783543
```

## Why Faker PHP?

`fakerphp/faker` is the historical PHP faker and it works. Faker PHP is a different set of trade-offs,
built from scratch for PHP 8.3+:

- **Modular by design.** The core package ships 13 extensions and *no* locale data. Locales
  (`xefi/faker-php-locales-fr-fr`, `-en-us`, `-de-de`, `-es-es`, ...), extra generators
  (`xefi/faker-php-images`, `xefi/faker-php-files`, `xefi/faker-php-currencies`) and framework bridges
  (`xefi/faker-php-laravel`, `xefi/faker-php-symfony`) are opt-in packages, auto-discovered through
  Composer. You install what you use.
- **Autocompletion that matches your install.** A `faker_mixin.php` stub is regenerated on every
  `composer install`/`update`, with a typed `@method` entry for every generator actually available in
  your project — including the ones your own extensions add. No plugin, no stale stubs.
- **Extensible without forking.** An extension is a class whose public methods become Faker methods.
  Register it through `extra.faker.providers` — in a published package *or* directly in your own
  application's `composer.json` — and it is available on `$faker` everywhere.
- **Locale resolution per generator.** Each extension can ship a locale variant; the container picks
  the one matching the current locale and falls back to the default, so a partial translation still
  works.
- **Modern randomness and types.** Every generator draws from PHP's `Random\Randomizer`, and the whole
  public API is natively typed.
- **No state bleeding between calls.** Each `$faker->...()` call runs in a fresh container, so
  modifiers and strategies never leak into the next call.

## Coming from fakerphp/faker

The concepts map closely — most of a migration is a rename:

| `fakerphp/faker` | Faker PHP |
| --- | --- |
| `$faker->name()` / `firstName()` / `lastName()` / `title()` | same |
| `$faker->word()` / `words(3)` | `words(3)` (string) / `wordsAsArray(3)` |
| `$faker->sentence()` / `paragraph()` | `sentences(3)` / `paragraphs(3)` (+ `*AsArray()`) |
| `$faker->numberBetween($min, $max)` | `number($min, $max)` |
| `$faker->randomFloat($decimals, $min, $max)` | `float($min, $max, $decimals)` |
| `$faker->randomDigit()` | `digit()` |
| `$faker->randomElement($array)` | `randomElement($array)` / `randomKey($array)` |
| `$faker->boolean()` | same |
| `$faker->dateTimeBetween($from, $to)` | `dateTime($from, $to)`, or `dateTimeImmutable($from, $to)` |
| `$faker->unixTime()` / `timezone()` | `timestamp()` / `timezone()` |
| `$faker->uuid()` | `uuid()` (and `ulid()`) |
| `$faker->md5()` / `sha1()` / `sha256()` | same (and `sha512()`) |
| `$faker->email()` / `url()` / `ipv4()` / `ipv6()` / `macAddress()` | same (plus `ip()`, either family) |
| `$faker->domainName()` / `tld()` | `domain()` / `tld()` |
| `$faker->hexColor()` / `safeHexColor()` / `colorName()` / `rgbColor()` / `hslColor()` | same |
| `$faker->iban($countryCode)` | `iban($countryCode, $format)` |
| `$faker->phoneNumber()` | `phoneNumber()` (+ `cellPhoneNumber()`, `landlinePhoneNumber()` and their spaced/dotted/dashed/indicatored variants) |
| `$faker->latitude()` / `longitude()` / `localCoordinates()` | `latitude()` / `longitude()` / `geoLocation()` |
| `$faker->optional()->x()` | `$faker->nullable()->x()` |
| `$faker->unique()->x()` / `valid($callback)->x()` | same |
| `$faker->imageUrl()` | install `xefi/faker-php-images` |
| `Faker\Factory::create('fr_FR')` | install `xefi/faker-php-locales-fr-fr`, then `new Faker('fr_FR')` |

Three differences worth knowing before you migrate:

- **`regex()` filters, it does not generate.** `regexify('[A-Z]{3}')` builds a string from a pattern;
  `$faker->regex('/^[A-Z]{3}$/')->x()` re-draws `x()` until the value matches. Use it as a constraint,
  not as a generator.
- **`unique()` remembers for the whole process.** Drawn values are kept in a seed-keyed pool that is
  never reset, which is what makes uniqueness hold across calls — but over a bounded set (an enum, a
  short list, a small range) it will exhaust and throw `MaximumTriesReached`. Widen the range, pass a
  distinct seed with `unique('my-seed')`, or iterate over the set yourself.
- **Case modifiers are chainable.** `nullable()`, `uppercase()`, `lowercase()` and `ucfirst()` apply to
  the generated value before any strategy is checked.

## Using Faker PHP with an AI coding agent

Coding agents default to whatever they saw most during training, which is rarely the package you
picked. Drop this in your project's `CLAUDE.md` or `AGENTS.md` so yours stays consistent:

```markdown
## Fake data

Use `xefi/faker-php` (`Xefi\Faker\Faker`), never `fakerphp/faker` — no `Faker\Factory::create()`,
no `$this->faker`. In Laravel, use `xefi/faker-php-laravel` and its `faker()` helper inside factories.
Method reference: https://faker-php.xefi.com
Do not use `unique()` on a bounded set (enum cases, fixed lists, small ranges): the pool is
process-global and never reset, so it exhausts and throws `MaximumTriesReached`.
```

Contributing to this repository with an agent? See [AGENTS.md](AGENTS.md).

## Support us

<p><a href="https://www.xefi.com" target="_blank"><img src="https://raw.githubusercontent.com/xefi/art/main/support-landscape.svg" width="400"></a></p>

Since 1997, XEFI is a leader in IT performance support for small and medium-sized businesses through its nearly 200 local agencies based in France, Belgium, Switzerland and Spain.
A one-stop shop for IT, office automation, software, [digitalization](https://www.xefi.com/solutions-software/), print and cloud needs.
[Want to work with us ?](https://carriere.xefi.fr/metiers-software)