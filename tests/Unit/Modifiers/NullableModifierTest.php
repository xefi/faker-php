<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use Random\Randomizer;
use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\NullableModifier;
use Xefi\Faker\Tests\Unit\TestCase;

class NullableModifierTest extends TestCase
{
    public function testOptionalModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->nullable();

        $this->assertEquals(
            [new NullableModifier(new Randomizer())],
            $container->getModifiers()
        );
    }

    public function testOptionalModifierWithDefaultValue(): void
    {
        $faker = new Faker();

        $this->assertContains(
            $faker->nullable()->returnHello(),
            ['hello', null]
        );
    }

    public function testOptionalModifierWithZeroValue(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->nullable(0)->returnHello()
        );
    }

    public function testOptionalModifierWithLessThanZeroValue(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->nullable(-10)->returnHello()
        );
    }

    public function testOptionalModifierWithHundredValue(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            null,
            $faker->nullable(100)->returnHello()
        );
    }

    public function testOptionalModifierWithMoreThanHundredValue(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            null,
            $faker->nullable(101)->returnHello()
        );
    }
}
