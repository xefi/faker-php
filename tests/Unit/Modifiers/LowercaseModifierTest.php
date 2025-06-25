<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\LowercaseModifier;
use Xefi\Faker\Tests\Unit\TestCase;

class LowercaseModifierTest extends TestCase
{
    public function testLowercaseModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->lowercase();

        $this->assertEquals(
            [new LowercaseModifier()],
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

    public function testLowercaseModifierWithAccent(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'éèàùâêîôûëïüç',
            $faker->lowercase()->returnAccentsUppercase()
        );
    }
}
