<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\Container\Container;
use Xefi\Faker\FakerServiceProvider;

class TestCase extends \Xefi\Faker\Tests\Unit\TestCase
{
    protected Container $faker;

    protected function setUp(): void
    {
        parent::setUp();

        (new FakerServiceProvider())->boot();

        $this->faker = new Container(false);
    }
}
