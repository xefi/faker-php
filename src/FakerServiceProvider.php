<?php

namespace Xefi\Faker;

use Xefi\Faker\Extensions\ColorsExtension;
use Xefi\Faker\Extensions\DateTimeExtension;
use Xefi\Faker\Extensions\FileExtension;
use Xefi\Faker\Extensions\FinancialExtension;
use Xefi\Faker\Extensions\HashExtension;
use Xefi\Faker\Extensions\InternetExtension;
use Xefi\Faker\Extensions\LoremExtension;
use Xefi\Faker\Extensions\NumbersExtension;
use Xefi\Faker\Extensions\PersonExtension;
use Xefi\Faker\Extensions\StringsExtension;
use Xefi\Faker\Providers\Provider;

class FakerServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            LoremExtension::class,
            NumbersExtension::class,
            StringsExtension::class,
            HashExtension::class,
            DateTimeExtension::class,
            InternetExtension::class,
            ColorsExtension::class,
            PersonExtension::class,
            FinancialExtension::class,
            FileExtension::class,
        ]);
    }
}
