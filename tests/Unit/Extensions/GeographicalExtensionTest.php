<?php

namespace Extensions;

use Xefi\Faker\Tests\Unit\Extensions\TestCase;

final class GeographicalExtensionTest extends TestCase
{
    public function testLatitude(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^-?(?:[0-8]?\d(?:\.\d{1,8})?|90(?:\.0+)?$)/', $this->faker->unique()->latitude());
        }
    }

    public function testLongitude(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^-?(?:1[0-7]\d(?:\.\d{1,8})?|180(?:\.0+)?|[0-9]?\d(?:\.\d{1,8})?)$/', $this->faker->unique()->longitude());
        }
    }

    public function testGeoLocation(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(-?(?:[0-8]?\d(?:\.\d+)?|90(?:\.0+)?)),\s*(-?(?:1[0-7]\d(?:\.\d+)?|180(?:\.0+)?|[0-9]?\d(?:\.\d+)?))$/', $this->faker->unique()->geoLocation());
        }
    }
}
