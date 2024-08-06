<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class StringTestExtension extends Extension
{
    // @TODO: calculate name from class name automatically
    protected string $name = 'string-test-extension';
    public function returnHello() {
        return 'hello';
    }
}