<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;
use Xefi\Faker\Exceptions\BadParameterException;
use Xefi\Faker\Extensions\ColorsExtension;

final class BooleanExtensionTest extends TestCase {
    public function testBoolean(): void
    {
        $results = [];
        for ($i = 0; $i < 2; $i++) {
            $results[] = $this->faker->unique()->boolean();
        }

        $this->assertEqualsCanonicalizing($results, [true, false]);
    }

    public function testBooleanAlwaysTrue(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertTrue($this->faker->boolean(100));
        }
    }

    public function testBooleanAlwaysFalse(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertFalse($this->faker->boolean(0));
        }
    }

    public function testBooleanWithDefaultPercentage(): void
    {
        $trueCount = 0;
        $falseCount = 0;

        for ($i = 0; $i < 1000; $i++) {
            if ($this->faker->boolean()) {
                $trueCount++;
            } else {
                $falseCount++;
            }
        }

        // We expect 50% of "true" so we check that there is minimum 45% of each value
        $this->assertGreaterThan(450, $trueCount);
        $this->assertGreaterThan(450, $falseCount);
    }

    public function testBooleanWithPercentage(): void
    {
        $trueCount = 0;
        $falseCount = 0;

        for ($i = 0; $i < 1000; $i++) {
            if ($this->faker->boolean(30)) {
                $trueCount++;
            } else {
                $falseCount++;
            }
        }

        // We expect 30% of "true" so we check that there is minimum 25% of "true" and 65% of "false"
        $this->assertGreaterThan(250, $trueCount);
        $this->assertGreaterThan(650, $falseCount);
    }

    public function testBooleanWithPercentageLowerThan100(): void
    {
        $this->expectException(BadParameterException::class);
        $this->faker->boolean(-1);
    }

    public function testBooleanWithPercentageGreaterThan100(): void
    {
        $this->expectException(BadParameterException::class);
        $this->faker->boolean(101);
    }
}