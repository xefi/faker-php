<?php

namespace Strategies;

use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Faker;
use Xefi\Faker\Strategies\UniqueStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class UniqueStrategyTest extends TestCase
{
    public function testUniqueStrategyRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->unique();

        $this->assertEquals(
            [new UniqueStrategy()],
            $container->getStrategies()
        );
    }

    public function testUniqueSingleTest(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->unique()->returnHello()
        );
    }

    public function testUniqueThrowExceptionOnMaxRetriesReached(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->unique()->returnHello()
        );

        $this->expectException(MaximumTriesReached::class);
        $this->expectExceptionMessage('Maximum tries of 20000 reached without finding a value');

        $faker->unique()->returnHello();
    }

    public function testUniqueGetAllElements(): void
    {
        $faker = new Faker();

        $numbers = [];
        for ($i = 0; $i < 10; $i++) {
            $numbers[] = $faker->unique()->returnNumberBetween(1, 10);
        }

        $this->assertEqualsCanonicalizing(range(1, 10), $numbers);
    }
}
