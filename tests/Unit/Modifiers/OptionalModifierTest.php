<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use PHPUnit\Framework\Attributes\DataProvider;
use Random\Randomizer;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\NullableModifier;
use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class OptionalModifierTest extends TestCase
{
    public function testOptionalModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->nullable();

        $this->assertEquals(
            [new NullableModifier(new Randomizer)],
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

    public function testOptionalModifierWithHundredValue(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            null,
            $faker->nullable(100)->returnHello()
        );
    }
}
