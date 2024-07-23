<?php

namespace Xefi\FakerNumbersStrings;

use Xefi\Faker\Providers\Provider as BaseServiceProvider;
use Xefi\FakerNumbersStrings\Extensions\NumberExtension;
use Xefi\FakerNumbersStrings\Extensions\StringExtension;

class NumbersStringsServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->extensions([
            NumberExtension::class,
            StringExtension::class
        ]);
    }
}