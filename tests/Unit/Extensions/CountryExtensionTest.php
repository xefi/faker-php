<?php

namespace Extensions;

use Random\Randomizer;
use Xefi\Faker\Tests\Unit\Extensions\TestCase;
use \Xefi\Faker\Extensions\CountryExtension;
final class CountryExtensionTest extends TestCase
{
    public function testCountry(): void
    {
        $this->assertMatchesRegularExpression('/^[a-zA-Z]*$/', $this->faker->country());
    }

    public function testCountryCodeISOAlpha2(): void
    {
        $this->assertMatchesRegularExpression('/^[A-Z]{2}$/', $this->faker->countryCodeISOAlpha2());
    }

    public function testCountryCodeISOAlpha3(): void
    {
        $this->assertMatchesRegularExpression('/^[A-Z]{3}$/', $this->faker->countryCodeISOAlpha3());
    }
}