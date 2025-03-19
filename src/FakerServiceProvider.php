<?php

namespace Xefi\Faker;

use Xefi\Faker\Extensions\ArrayExtension;
use Xefi\Faker\Extensions\BooleanExtension;
use Xefi\Faker\Extensions\ColorsExtension;
use Xefi\Faker\Extensions\CurrencyExtension;
use Xefi\Faker\Extensions\DateTimeExtension;
use Xefi\Faker\Extensions\FinancialExtension;
use Xefi\Faker\Extensions\HashExtension;
use Xefi\Faker\Extensions\InternetExtension;
use Xefi\Faker\Extensions\NumbersExtension;
use Xefi\Faker\Extensions\PersonExtension;
use Xefi\Faker\Extensions\StringsExtension;
use Xefi\Faker\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            TextExtension::class,
            NumbersExtension::class,
            StringsExtension::class,
            HashExtension::class,
            DateTimeExtension::class,
            InternetExtension::class,
            ColorsExtension::class,
            PersonExtension::class,
            FinancialExtension::class,
            BooleanExtension::class,
            ArrayExtension::class,
            CurrencyExtension::class,
        ]);
    }
}
