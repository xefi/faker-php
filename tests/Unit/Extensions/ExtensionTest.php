<?php

namespace Extensions;

use Xefi\Faker\Container\Container;
use Xefi\Faker\Tests\Unit\TestCase;

class ExtensionTest extends TestCase
{
    public function testExtensionReturnHello(): void
    {
        $container = new Container();

        $this->assertEquals(
            'hello',
            $container->returnHello()
        );
    }

    public function testExtensionReturnOne(): void
    {
        $container = new Container();

        $this->assertEquals(
            1,
            $container->returnOne()
        );
    }
}
