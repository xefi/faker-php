<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class StringTestExtension extends Extension
{
    public function returnHello()
    {
        return 'hello';
    }

    public function returnHelloUppercase()
    {
        return 'HELLO';
    }
}
