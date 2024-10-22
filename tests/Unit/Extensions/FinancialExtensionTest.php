<?php

namespace Extensions;

use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\Tests\Unit\Extensions\TestCase;

final class FinancialExtensionTest extends TestCase
{
    public function testIban()
    {
        $iban = $this->faker->iban();

        $this->assertEquals(28, strlen($iban));
        $this->assertMatchesRegularExpression('/^[A-Z]{2}/', $iban, 'IBAN does\'t contain a country code');
        $this->assertTrue(Iban::isValid($iban));
    }

    public function testIbanWithCustomCountryCode()
    {
        $iban = $this->faker->iban(countryCode: 'FR');

        $this->assertEquals(28, strlen($iban));
        $this->assertStringStartsWith('FR', $iban);
    }

    public function testIbanWithAnyFormat()
    {
        $iban = $this->faker->iban(format: str_repeat('{a}', 10));

        $this->assertEquals(14, strlen($iban));
        $this->assertMatchesRegularExpression('/^[A-Z0-9]+$/', substr($iban, 4));
    }

    public function testIbanWithLetterFormat()
    {
        $iban = $this->faker->iban(format: str_repeat('{l}', 10));

        $this->assertEquals(14, strlen($iban));
        $this->assertMatchesRegularExpression('/^[A-Z]+$/', substr($iban, 4));
    }

    public function testIbanWithDigitFormat()
    {
        $iban = $this->faker->iban(format: str_repeat('{d}', 10));

        $this->assertEquals(14, strlen($iban));
        $this->assertMatchesRegularExpression('/^[0-9]+$/', substr($iban, 4));
    }
}
