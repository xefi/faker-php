<?php

namespace Xefi\Faker\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Extensions\Extension;

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

    public function testExtensionPickArrayRandomKeys(): void
    {
        $elements = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
        ];

        $method = (new ReflectionClass(Extension::class))->getMethod('pickArrayRandomKeys');
        $result = $method->invoke(new Extension(new Randomizer()), $elements, 3);

        $this->assertCount(
            3,
            $result
        );

        foreach ($result as $key) {
            $this->assertArrayHasKey($key, $elements);
            $this->assertIsString($key);
        }
    }

    public function testExtensionPickArrayRandomKey(): void
    {
        $elements = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
        ];

        $method = (new ReflectionClass(Extension::class))->getMethod('pickArrayRandomKeyNumber');
        $result = $method->invoke(new Extension(new Randomizer()), $elements);

        $this->assertArrayHasKey($result, $elements);
        $this->assertIsString($result);
    }
}
