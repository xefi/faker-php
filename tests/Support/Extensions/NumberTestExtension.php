<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class NumberTestExtension extends Extension
{
    public function returnOne()
    {
        return 1;
    }

    public function returnNumberBetween($min, $max)
    {
        return rand($min, $max);
    }
}
