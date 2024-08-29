<?php

namespace Xefi\Faker\Tests\Support;

use Xefi\Faker\Providers\Provider;
use Xefi\Faker\Tests\Support\Extensions\NumberTestExtension;
use Xefi\Faker\Tests\Support\Extensions\StringTestExtension;

class TestServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            NumberTestExtension::class,
            StringTestExtension::class,
        ]);
    }
}
