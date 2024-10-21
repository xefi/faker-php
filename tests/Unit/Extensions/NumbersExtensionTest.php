<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

final class NumbersExtensionTest extends TestCase
{
    public function testDigit(): void
    {
        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $results[] = $this->faker->unique()->digit();
        }

        $this->assertEqualsCanonicalizing(
            range(0, 9),
            $results
        );
    }

    public function testNumberBetweenWithUniqueValues(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->unique()->numberBetween(1, 100);
        }

        $this->assertEqualsCanonicalizing(
            range(1, 100),
            $results
        );
    }

    public function testNumberBetweenWithRandomValues(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->numberBetween(1, 100);
        }

        foreach ($results as $result) {
            $this->assertLessThanOrEqual(100, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }

    public function testFloatBetweenWithRandomValues(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->floatBetween(1, 100);
        }

        foreach ($results as $result) {
            $this->assertLessThanOrEqual(100, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }
}
