<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class TestExtension extends Extension
{
    protected string $name = 'test-extension';
    public function returnOne() {
        return 1;
    }
}