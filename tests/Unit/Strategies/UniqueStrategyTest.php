<?php

namespace Xefi\Faker\Tests\Unit\Strategies;

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
        $this->expectExceptionMessage('Maximum of 20000 tries reached while generating a value for "returnHello". This usually means the active constraints (e.g. unique, valid, or custom strategies) have exhausted the available pool of values. Consider relaxing your constraints, broadening the input range, or removing the unique requirement if the data set is too small.');

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

    public function testUniqueKeepsStrictComparison(): void
    {
        $strategy = new UniqueStrategy();

        $this->assertTrue($strategy->pass(1));
        $this->assertTrue($strategy->pass(1.0));
        $this->assertTrue($strategy->pass('1'));
        $this->assertTrue($strategy->pass(true));
        $this->assertTrue($strategy->pass(null));

        $this->assertFalse($strategy->pass(1));
        $this->assertFalse($strategy->pass('1'));
        $this->assertFalse($strategy->pass(null));
    }

    public function testUniqueComparesObjectsByValue(): void
    {
        $strategy = new UniqueStrategy();

        $this->assertTrue($strategy->pass(new \DateTime('2020-01-01 00:00:00')));
        $this->assertFalse($strategy->pass(new \DateTime('2020-01-01 00:00:00')));
        $this->assertTrue($strategy->pass(new \DateTime('2020-01-02 00:00:00')));
    }
}
