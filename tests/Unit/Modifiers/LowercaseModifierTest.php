<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use PHPUnit\Framework\Attributes\DataProvider;
use Random\Randomizer;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\LowercaseModifier;
use Xefi\Faker\Modifiers\NullableModifier;
use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class LowercaseModifierTest extends TestCase
{
    public function testLowercaseModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->lowercase();

        $this->assertEquals(
            [new LowercaseModifier],
            $container->getModifiers()
        );
    }

    public function testLowercaseModifier(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->lowercase()->returnHelloUppercase(),
        );
    }
}
