<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\UcfirstModifier;
use Xefi\Faker\Modifiers\UppercaseModifier;
use Xefi\Faker\Tests\Unit\TestCase;

class UcfirstModifierTest extends TestCase
{
    public function testUcfirstModifierRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->ucfirst();

        $this->assertEquals(
            [new UcfirstModifier()],
            $container->getModifiers()
        );
    }

    public function testUppercaseModifier(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'Hello',
            $faker->ucfirst()->returnHello()
        );
    }

    public function testUppercaseModifierWithAccent(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'Éèàùâêîôûëïüç',
            $faker->ucfirst()->returnAccentsLowercase()
        );
    }
}
