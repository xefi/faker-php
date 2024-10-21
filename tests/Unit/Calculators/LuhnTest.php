<?php

namespace Xefi\Faker\Tests\Unit\Calculators;

use PHPUnit\Framework\Attributes\DataProvider;
use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\Tests\Unit\TestCase;

final class LuhnTest extends TestCase
{
    public static function validatorProvider(): array
    {
        return [
            ['79927398710', false],
            ['79927398711', false],
            ['79927398712', false],
            ['79927398713', true],
            ['79927398714', false],
            ['79927398715', false],
            ['79927398716', false],
            ['79927398717', false],
            ['79927398718', false],
            ['79927398719', false],
            [79927398713, true],
            [79927398714, false],
        ];
    }

    #[DataProvider('validatorProvider')]
    public function testIsValid($number, $isValid): void
    {
        $this->assertEquals($isValid, Luhn::isValid((string) $number));
    }
}