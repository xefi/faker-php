<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\Container\Container;

final class NumbersExtensionTest extends TestCase
{
    public function testDigit(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $results[] = $faker->unique()->digit();
        }

        $this->assertEqualsCanonicalizing(
            range(0, 9),
            $results
        );
    }

    public function testNumberBetweenWithUniqueValues(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->unique()->numberBetween(1, 100);
        }

        $this->assertEqualsCanonicalizing(
            range(1, 100),
            $results
        );
    }

    public function testNumberBetweenWithRandomValues(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->numberBetween(1, 100);
        }

        foreach ($results as $result) {
            $this->assertLessThanOrEqual(100, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }

    public function testFloatBetweenWithRandomValues(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->floatBetween(1, 100);
        }

        foreach ($results as $result) {
            $this->assertLessThanOrEqual(100, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }
}
