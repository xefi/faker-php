# AGENTS.md

Instructions for AI coding agents working **on this repository** (`xefi/faker-php`).
If you are working on a project that *consumes* this package, read the "Using Faker PHP with an AI agent"
section of the [README](README.md) instead.

## What this repository is

`xefi/faker-php` is a standalone, framework-agnostic fake data generator for PHP 8.3+.
It is the core package only. Locales, framework bridges and extra generators live in separate
repositories (`xefi/faker-php-laravel`, `xefi/faker-php-symfony`, `xefi/faker-php-locales-*`,
`xefi/faker-php-images`, ...). Do not add locale data or framework-specific code here.

## Commands

```bash
composer install          # also regenerates the IDE mixin via post-install-cmd
composer test             # PHPUnit 12 test suite
composer generate-mixin   # regenerate faker_mixin.php by hand
```

CI runs the suite on PHP 8.3, 8.4 and 8.5, against both `lowest` and `highest` dependencies,
and runs `composer validate`. Keep changes compatible with all three PHP versions.

## Architecture

```
Faker ──(__call, one fresh Container per call)──▶ Container
                                                    │
        registered providers ──▶ extensions ──▶ method map (method → extension name)
                                                    │
                                   run(): generate ──▶ modifiers ──▶ strategies (retry until pass)
```

- **`Faker`** (`src/Faker.php`) is a thin entry point. Every call builds a new `Container`, so
  modifiers and strategies never leak between two calls.
- **`Container`** (`src/Container/Container.php`) composes four traits: `HasExtensions`,
  `HasModifiers`, `HasStrategies`, `HasLocale`. `run()` generates a value, applies the modifiers,
  then loops until the strategies pass — capped at 20 000 tries before throwing `MaximumTriesReached`.
- **Extensions** (`src/Extensions/`) hold the actual generators. Every **public** method of an
  extension becomes a Faker method; `getName()` and `__construct` are skipped.
- **Providers** (`src/Providers/`) register extensions through `Container::starting()`.
- **`PackageManifest`** discovers providers from `extra.faker.providers` in every installed package's
  `composer.json` *and* in the consuming project's own `composer.json`, then caches the result in
  `packages.php`.
- **`ContainerMixinManifest`** generates `faker_mixin.php`, a `@method` docblock stub that gives IDEs
  autocompletion for whatever extensions are installed. Both manifests recompile when
  `vendor/composer/installed.json` or the project `composer.json` is newer than the generated file.

`packages.php` and `faker_mixin.php` are generated artifacts and are git-ignored. Never commit them.

## Conventions

- No `declare(strict_types=1)` in `src/`: do not introduce it there. A few test files do declare it;
  follow the file you are editing.
- Native parameter and return types plus a full docblock (`@param`, `@return`) on every new or modified
  method. Some older methods (`email()`, `macAddress()`, `letter()`, ...) still lack a return type; add
  one when you touch them, do not copy them.
- Randomness goes through the injected `Random\Randomizer` (`$this->randomizer`), never `rand()`,
  `mt_rand()`, `random_bytes()`, `array_rand()` or `shuffle()`, so a seeded engine gives reproducible
  output. Use the `Extension` helpers (`pickArrayRandomElement`, `pickArrayRandomKeys`, `formatString`,
  ...) when they fit. `uuid()`, `ulid()`, `phoneNumber()` and `url()` still break this rule; they are
  known debt, not examples.
- Method names are **globally unique across all extensions**, including third-party ones. For a regular
  extension, a collision triggers an `E_USER_WARNING` and the **last** registration overwrites the
  method; for locale variants, the method already mapped is kept silently. Pick names that are unlikely
  to clash with an extension package, and never rename an existing method without a major version
  bump.

### Adding a generator

1. Add a public method to the relevant class in `src/Extensions/`, or create a new `*Extension`
   extending `Xefi\Faker\Extensions\Extension`.
2. Register a new extension class in `FakerServiceProvider::boot()`.
3. Add a unit test under `tests/Unit/Extensions/`.
4. Locale-aware extensions use the `Extensions\Traits\HasLocale` trait; the container resolves the
   variant matching the current locale and falls back to `Locales::DEFAULT`. Locale data itself
   belongs in a `xefi/faker-php-locales-*` package, not here.

## Tests

- PHPUnit 12, tests live in `tests/Unit/` and mirror `src/`.
- Extend `Xefi\Faker\Tests\Unit\TestCase`: it points the container base path at `tests/Support` and
  redirects both generated manifests to `/tmp` so the real ones are never touched.
- Tests that need a full project layout (vendor dir, `installed.json`, `composer.json`) use
  `tests/Support/Concerns/CreatesTemporaryProjects`.
- Extension tests generally assert against the extension's own data set, read back through reflection,
  rather than hardcoding expected values.

## Gotchas

- **`Container::$extensions` and `$extensionsMethods` are static**, so the registered extension set is
  process-global and survives between tests. `forgetExtensions()` exists for that reason.
- **Bootstrappers are static too, and they accumulate.** Every provider boot appends a
  `Container::starting()` callback. To re-initialize extensions through the constructor in a test, call
  `forgetExtensions()` *and* `forgetBootstrappers()`, otherwise the providers register twice and every
  extension triggers an "already registered" warning.
- **`unique()` draws from a process-global, seed-keyed pool that is never reset** (`Seeds\HasSeeds`).
  Over a bounded set — an enum, a fixed list, a small integer range — it exhausts and then throws
  `MaximumTriesReached` in every later call of the same process. Never suggest `unique()` on a bounded
  set; widen the range or iterate over the set instead.
- Modifiers are applied **before** strategies are checked, so a strategy always sees the final value.

## Pull requests

- Target `main`, one focused change per PR.
- Keep the README, the docs site (`faker-php.xefi.com`, separate repository) and this file in sync when
  the public API changes.
- Do not add AI attribution to commits or PR descriptions.
