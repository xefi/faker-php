<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use PHPUnit\Framework\Attributes\DataProvider;
use Random\Randomizer;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\LowercaseModifier;
use Xefi\Faker\Modifiers\NullableModifier;
use Xefi\Faker\Modifiers\UppercaseModifier;
use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class UppercaseModifierTest extends TestCase
{
    public function testUppercaseModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->uppercase();

        $this->assertEquals(
            [new UppercaseModifier],
            $container->getModifiers()
        );
    }

    public function testUppercaseModifier(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'HELLO',
            $faker->uppercase()->returnHello()
        );
    }
}
