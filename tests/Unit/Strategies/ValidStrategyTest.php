<?php

namespace Strategies;

use Xefi\Faker\Faker;
use Xefi\Faker\Strategies\ValidStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class ValidStrategyTest extends TestCase
{
    /**
     * @throws \ErrorException
     */
    public function testValidStrategyRegistered(): void
    {
        $faker = new Faker();

        $function = function ($number) {return $number % 2 === 0; };

        $container = $faker->valid($function);

        $this->assertEquals(
            [new ValidStrategy($function)],
            $container->getStrategies()
        );
    }

    public function testValidStrategyWithMultiplesValuesWithModOperator(): void
    {
        $faker = new Faker();

        $function = function ($number) {return $number % 2 === 0; };

        $intArray = [];
        for ($i = 0; $i < 10; $i++) {
            $intArray[] = $faker->valid($function)->returnNumberBetween(0, 10);
        }

        $this->assertEquals(0, array_sum($intArray) % 2);
    }

    public function testValidStrategyWithMultiplesValuesWithGTOperator(): void
    {
        $faker = new Faker();

        $function = function ($number) {return $number > 5; };

        $intArray = [];
        for ($i = 0; $i < 10; $i++) {
            $intArray[] = $faker->valid($function)->returnNumberBetween(0, 10);
        }

        $this->assertTrue(min($intArray) > 5);
    }

    public function testValidStrategyWithCallableWithoutParameter(): void
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('The callable must have 1 parameter');

        $faker = new Faker();

        $function = function () {return 0; };

        $faker->valid($function)->returnNumberBetween(0, 10);
    }

    public function testValidStrategyWithCallableWithBadReturnType(): void
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('The callable must return a value of type bool');

        $faker = new Faker();

        $function = function ($number) {return ''; };

        $faker->valid($function)->returnNumberBetween(0, 10);
    }
}
