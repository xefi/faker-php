<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class NumberTestExtension extends Extension
{
    protected string $name = 'number-test-extension';
    public function returnOne() {
        return 1;
    }
}