<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\FakerServiceProvider;

class TestCase extends \Xefi\Faker\Tests\Unit\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        (new FakerServiceProvider())->boot();
    }
}
