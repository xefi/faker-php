<?php

/**
 * Script to generate the IDE mixin for Xefi/Faker.
 *
 * This file is executed during Composer install/update via the "generate-mixin" script.
 * It bootstraps the autoloader and instantiates the Xefi\Faker\Container\Container,
 * which produces the mixin file used by supported IDEs to enable autocompletion.
 *
 * Running this ensures that developers get proper type hints and code completion
 * when working with xefi/faker-php in their projects.
 */

require __DIR__ . '/../vendor/autoload.php';

new \Xefi\Faker\Container\Container;
