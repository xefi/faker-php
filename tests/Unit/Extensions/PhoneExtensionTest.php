<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumberReturnsString(): void
    {
        $number = $this->faker->phoneNumber();

        $this->assertIsString($number);
        $this->assertNotEmpty($number);
    }

    public function testPhoneNumberWithDefaultSettings(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $number = $this->faker->phoneNumber();

            $this->assertMatchesRegularExpression(
                '/^(\d{4}|\d{8}|\d{10})$/',
                $number
            );
        }
    }

    public function testPhoneNumberWithFormat(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber('{d}{d}{d}-{d}{d}{d}');

            $this->assertMatchesRegularExpression(
                '/^\d{3}-\d{3}$/',
                $number
            );
        }
    }

    public function testPhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber('{d}{d}{d}{separator}{d}{d}{d}', '-');

            $this->assertMatchesRegularExpression(
                '/^\d{3}-\d{3}$/',
                $number
            );
        }

        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber('{d}{d}{d}{separator}{d}{d}{d}', '.');

            $this->assertMatchesRegularExpression(
                '/^\d{3}.\d{3}$/',
                $number
            );
        }

        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber('{d}{d}{d}{separator}{d}{d}{d}', ' ');

            $this->assertMatchesRegularExpression(
                '/^\d{3} \d{3}$/',
                $number
            );
        }
    }

    public function testPhoneNumberWithPrefix(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber(format: '{d}{d}{d}', prefix: '+33');

            $this->assertMatchesRegularExpression(
                '/^\+33\d{3}$/',
                $number
            );
        }

        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->phoneNumber('{d}{d}{d}{separator}{d}{d}{d}', '.', '0');

            $this->assertMatchesRegularExpression(
                '/^0\d{3}.\d{3}$/',
                $number
            );
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->cellPhoneNumber();

            $this->assertMatchesRegularExpression(
                '/^\d{4}$/',
                $number
            );
        }
    }

    public function testCellPhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->cellPhoneNumber('.');

            $this->assertMatchesRegularExpression(
                '/^\d{2}\.\d{2}$/',
                $number
            );
        }
    }

    public function testCellPhoneNumberWithPrefix(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->cellPhoneNumber(prefix: '+33');

            $this->assertMatchesRegularExpression(
                '/^\+33\d{4}$/',
                $number
            );
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->landlinePhoneNumber();

            $this->assertMatchesRegularExpression(
                '/^\d{8}|\d{10}$/',
                $number
            );
        }
    }

    public function testLandlinePhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->landlinePhoneNumber('.');

            $this->assertMatchesRegularExpression(
                '/^\d{2}\.\d{2}\.\d{2}\.\d{2}(\.\d{2})?$/',
                $number
            );
        }
    }

    public function testLandlinePhoneNumberWithPrefix(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->landlinePhoneNumber(prefix: '+33');

            $this->assertMatchesRegularExpression(
                '/^\+33\d{8}|\d{10}$/',
                $number
            );
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredPhoneNumber();

            $this->assertMatchesRegularExpression(
                '/^\+00(\d{4}|\d{8}|\d{10})$/',
                $number
            );
        }
    }

    public function testIndicatoredPhoneNumberWithFormat(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredPhoneNumber(format: '{d}{d}{d}{d}{d}{d}');

            $this->assertMatchesRegularExpression(
                '/^\+00(\d{6})$/',
                $number
            );
        }
    }

    public function testIndicatoredPhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredPhoneNumber(format: '{d}{d}{separator}{d}{d}{separator}{d}{d}', separator: '-');

            $this->assertMatchesRegularExpression(
                '/^\+00(\d{2}-\d{2}-\d{2})$/',
                $number
            );
        }
    }

    public function testIndicatoredCellPhoneNumber(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredCellPhoneNumber();

            $this->assertMatchesRegularExpression(
                '/^\+00\d{4}$/',
                $number
            );
        }
    }

    public function testIndicatoredCellPhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredCellPhoneNumber('.');

            $this->assertMatchesRegularExpression(
                '/^\+00\d{2}\.\d{2}$/',
                $number
            );
        }
    }

    public function testIndicatoredLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredLandlinePhoneNumber();

            $this->assertMatchesRegularExpression(
                '/^\+00(\d{8}|\d{10})$/',
                $number
            );
        }
    }

    public function testIndicatoredLandlinePhoneNumberWithSeparator(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $number = $this->faker->indicatoredLandlinePhoneNumber('.');

            $this->assertMatchesRegularExpression(
                '/^\+00\d{2}\.\d{2}\.\d{2}\.\d{2}(\.\d{2})?$/',
                $number
            );
        }
    }
}
