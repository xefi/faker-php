<?php

namespace Xefi\Faker\Tests\Unit\Strategies;

use PHPUnit\Framework\Attributes\DataProvider;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Faker;
use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Tests\Unit\TestCase;

class RegexStrategyTest extends TestCase
{
    public function testRegexStrategyRegistered(): void
    {
        $faker = new Faker();

        $container = $faker->regex('//');

        $this->assertEquals(
            [new RegexStrategy('//')],
            $container->getStrategies()
        );
    }

    public function testUniqueSingleTest(): void
    {
        $faker = new Faker();

        $this->assertEquals(
            'hello',
            $faker->regex('//')->returnHello()
        );
    }

    public function testUniqueThrowExceptionOnMaxRetriesReached(): void
    {
        $faker = new Faker();

        $this->expectException(MaximumTriesReached::class);
        $this->expectExceptionMessage('Maximum of 20000 tries reached while generating a value for "returnHello". This usually means the active constraints (e.g. unique, valid, or custom strategies) have exhausted the available pool of values. Consider relaxing your constraints, broadening the input range, or removing the unique requirement if the data set is too small.');

        $faker->regex('/^\d$/')->returnHello();
    }

    public static function regexProvider(): array
    {
        return [
            ['/\d/', 0, 9],
            ['/\d+/', 0, 100],
            ['/^[1-9]\d*$/', 1, 1000],
            ['/^-?\d+$/', -100, 100],
            ['/^[0-9]{1,3}$/', 0, 999],
            ['/^[1-9][0-9]{2,5}$/', 100, 999999],
            ['/^0$/', 0, 0],
        ];
    }

    #[DataProvider('regexProvider')]
    public function testMultipleRegexCases(string $regex, int $min, int $max): void
    {
        $faker = new Faker();

        $result = $faker->regex($regex)->returnNumberBetween($min, $max);

        $this->assertMatchesRegularExpression($regex, (string) $result);
    }
}
