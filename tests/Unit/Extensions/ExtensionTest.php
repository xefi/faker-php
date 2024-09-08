<?php

namespace Extensions;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Extensions\Extension;
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

    public function testExtensionPickArrayRandomElements(): void
    {
        $elements = range(1, 100);

        $method = (new ReflectionClass(Extension::class))->getMethod('pickArrayRandomElements');
        $result = $method->invoke(new Extension(new Randomizer()), $elements, 5);

        $this->assertCount(
            5,
            $result
        );

        foreach ($result as $item) {
            $this->assertGreaterThanOrEqual(1, $item);
            $this->assertLessThanOrEqual(100, $item);
        }
    }

    public function testExtensionPickArrayRandomElement(): void
    {
        $elements = range(1, 100);

        $method = (new ReflectionClass(Extension::class))->getMethod('pickArrayRandomElement');
        $result = $method->invoke(new Extension(new Randomizer()), $elements);

        $this->assertIsNotArray($result);
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(100, $result);
    }
}
