<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;
use Xefi\Faker\Extensions\CurrencyExtension;

final class CurrencyExtensionTest extends TestCase
{
    protected array $currencies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $currencyExtension = new CurrencyExtension(new Randomizer());
        $this->currencies = (new \ReflectionClass($currencyExtension))->getProperty('currencies')->getValue($currencyExtension);
    }

    public function testCurrency()
    {
        for ($i = 0; $i < count($this->currencies); $i++) {
            $currency = $this->faker->currency();

            $this->assertIsArray($currency);
            $this->assertArrayHasKey('code', $currency);
            $this->assertArrayHasKey('name', $currency);
            $this->assertArrayHasKey('symbol', $currency);
        }
    }

    public function testCurrencyCode()
    {
        for ($i = 0; $i < count($this->currencies); $i++) {
            $code = $this->faker->unique()->currencyCode();

            $this->assertIsString($code);
            $this->assertEquals(3, strlen($code));
        }
    }

    public function testCurrencyName()
    {
        for ($i = 0; $i < count($this->currencies); $i++) {
            $name = $this->faker->unique()->currencyName();

            $this->assertIsString($name);
            $this->assertNotEmpty($name);
        }
    }

    public function testCurrencySymbol()
    {
        for ($i = 0; $i < count($this->currencies); $i++) {
            $symbol = $this->faker->unique()->currencySymbol();

            $this->assertIsString($symbol);
            $this->assertNotEmpty($symbol);
        }
    }
}