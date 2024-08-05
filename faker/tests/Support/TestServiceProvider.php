<?php

namespace Xefi\Faker\Tests\Support;

use Xefi\Faker\Providers\Provider;
use Xefi\Faker\Tests\Support\Extensions\TestExtension;

class TestServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            TestExtension::class
        ]);
    }
}