<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;
use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\Extensions\ColorsExtension;
use Xefi\Faker\Extensions\PhoneExtension;

final class PhoneExtensionTest extends TestCase
{
    protected array $formats = [];

    protected function setUp(): void
    {
        parent::setUp();

        $phoneExtension = new PhoneExtension(new Randomizer());
        $this->formats = (new \ReflectionClass($phoneExtension))->getProperty('formats')->getValue($phoneExtension);
    }

    public function testPhoneNumberReturnsString(): void
    {
        $number = $this->faker->phoneNumber();

        $this->assertIsString($number);
        $this->assertNotEmpty($number);
    }

    public function testPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; ++$i) {
            $number = $this->faker->phoneNumber();

            $this->assertMatchesRegularExpression(
                '/^(\d{3}|\d{10}|\+\d{9})$/',
                $number
            );
        }
    }
}
