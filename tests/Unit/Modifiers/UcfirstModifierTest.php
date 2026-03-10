<?php

namespace Xefi\Faker\Tests\Unit\Modifiers;

use Xefi\Faker\Faker;
use Xefi\Faker\Modifiers\UcfirstModifier;
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

    public function testUcfirstModifier(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'Hello',
            $faker->ucfirst()->returnHello()
        );
    }

    public function testUcfirstModifierWithAccentBeforePhp84(): void
    {
        $faker = new Faker();

        if (PHP_VERSION_ID < 80400) {
            $this->markTestSkipped();
        }

        $this->assertEquals(
            'Éèàùâêîôûëïüç',
            $faker->ucfirst()->returnAccentsLowercase()
        );
    }

    public function testUcfirstModifierWithAccentAfterPhp84(): void
    {
        $faker = new Faker();

        if (PHP_VERSION_ID >= 80400) {
            $this->markTestSkipped();
        }

        $this->assertEquals(
            'éèàùâêîôûëïüç',
            $faker->ucfirst()->returnAccentsLowercase()
        );
    }
}
