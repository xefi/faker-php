<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

final class CurrencyExtensionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCurrency()
    {
        for ($i = 0; $i < 100; $i++) {
            $currency = $this->faker->currency();

            $this->assertIsArray($currency);
            $this->assertArrayHasKey('code', $currency);
            $this->assertArrayHasKey('name', $currency);
            $this->assertArrayHasKey('symbol', $currency);
        }
    }

    public function testCurrencyCode()
    {
        for ($i = 0; $i < 100; $i++) {
            $code = $this->faker->currencyCode();

            $this->assertIsString($code);
            $this->assertEquals(3, strlen($code));
        }
    }

    public function testCurrencyName()
    {
        for ($i = 0; $i < 100; $i++) {
            $name = $this->faker->currencyName();

            $this->assertIsString($name);
            $this->assertNotEmpty($name);
        }
    }

    public function testCurrencySymbol()
    {
        for ($i = 0; $i < 100; $i++) {
            $symbol = $this->faker->currencySymbol();

            $this->assertIsString($symbol);
            $this->assertNotEmpty($symbol);
        }
    }

    public function testUniqueCurrency()
    {
        $uniqueCurrencies = [];

        for ($i = 0; $i < 100; $i++) {
            $currency = $this->faker->unique()->currency();
            $this->assertIsArray($currency);
            $this->assertArrayHasKey('code', $currency);
            $this->assertArrayHasKey('name', $currency);
            $this->assertArrayHasKey('symbol', $currency);

            // Ensure the currency is unique
            $this->assertNotContains($currency['code'], $uniqueCurrencies);
            $uniqueCurrencies[] = $currency['code'];
        }
    }
}