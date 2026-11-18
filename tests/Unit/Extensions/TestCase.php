<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Engine\Mt19937;
use Xefi\Faker\Container\Container;
use Xefi\Faker\FakerServiceProvider;

class TestCase extends \Xefi\Faker\Tests\Unit\TestCase
{
    protected Container $faker;

    protected function setUp(): void
    {
        parent::setUp();

        (new FakerServiceProvider())->boot();

        $this->faker = new Container(new Mt19937(19937), false);
    }

    protected function createFresh(): Container
    {
        $this->faker->forgetBootstrappers();
        $this->faker->forgetExtensions();
        $this->faker->forgetModifiers();
        $this->faker->forgetStrategies();

        (new FakerServiceProvider())->boot();

        return new Container(new Mt19937(19937), false);
    }
}
