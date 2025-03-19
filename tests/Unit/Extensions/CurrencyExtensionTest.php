<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

final class CurrencyExtensionTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testItCanGenerateARandomCurrency()
    {
        $currency = $this->faker->currency();

        $this->assertIsArray($currency);
        $this->assertArrayHasKey('code', $currency);
        $this->assertArrayHasKey('name', $currency);
        $this->assertArrayHasKey('symbol', $currency);
    }

    public function testItCanGenerateACurrencyCode()
    {
        $code = $this->faker->currencyCode();

        $this->assertIsString($code);
        $this->assertEquals(3, strlen($code));
    }

    public function testItCanGenerateACurrencyName()
    {
        $name = $this->faker->currencyName();

        $this->assertIsString($name);
        $this->assertNotEmpty($name);
    }

    public function testItCanGenerateACurrencySymbol()
    {
        $symbol = $this->faker->currencySymbol();

        $this->assertIsString($symbol);
        $this->assertNotEmpty($symbol);
    }
}
