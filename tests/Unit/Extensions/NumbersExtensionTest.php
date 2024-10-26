<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;

final class NumbersExtensionTest extends TestCase
{
    public function testDigit(): void
    {
        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $results[] = $this->faker->unique()->digit();
        }

        $this->assertEqualsCanonicalizing(
            range(0, 9),
            $results
        );
    }

    public function testNumberWithUniqueValues(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->unique()->number(1, 100);
        }

        $this->assertEqualsCanonicalizing(
            range(1, 100),
            $results
        );
    }

    public function testNumberWithRandomValues(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->number(1, 100);
        }

        foreach ($results as $result) {
            $this->assertLessThanOrEqual(100, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }

    public static function floatProvider()
    {
        return [
            [1.0, 10.0, 2],
            [0.0, 1.0, 4],
            [-10.0, 10.0, 3],
            [5.5, 5.9, 1],
            [0.1, 0.2, 6],
            [-1000.0, 1000.0, 0],
            [3.333, 3.334, 5],
            [-50.0, -25.0, 2],
            [0.0, 0.1, 1],
            [999.9, 1000.0, 1],
            [-100.0, 100.0, 1],
            [50.0, 100.0, 0],
            [0.1234, 0.5678, 4],
            [10.5, 10.9, 2],
            [-0.1, 0.1, 5],
            [-200.0, -100.0, 1],
            [0.0001, 0.0002, 6],
            [-5.555, 5.555, 3],
            [0.0, 100000.0, 0],
            [123.456, 789.012, 3],
            [-0.0001, 0.0001, 6],
            [1.111, 1.119, 4],
            [2500.0, 5000.0, 0],
            [-0.999, 0.999, 2],
            [1234.567, 2345.678, 3],
            [-300.3, -100.1, 1],
            [0.000001, 0.000009, 7],
            [-50.25, -50.1, 2],
            [9.99, 10.0, 1],
            [10.20, 10.20, 2],
        ];
    }

    #[DataProvider('floatProvider')]
    public function testFloatWithRandomValues(float $min, float $max, int $decimals): void
    {
        $result = $this->faker->float($min, $max, $decimals);

        $this->assertLessThanOrEqual($this->numberFormatPrecision($max, $decimals), $result);
        $this->assertGreaterThanOrEqual($this->numberFormatPrecision($min, $decimals), $result);

        $formattedResult = number_format($result, $decimals, '.', '');
        $decimalParts = explode('.', $formattedResult);
        $decimalCount = isset($decimalParts[1]) ? strlen($decimalParts[1]) : 0;
        $this->assertEquals($decimals, $decimalCount);
    }

    /**
     * Used to cut numbers without round.
     *
     * @param float  $number
     * @param int    $precision
     * @param string $separator
     *
     * @return string
     */
    protected function numberFormatPrecision(float $number, int $precision = 2, string $separator = '.')
    {
        $numberParts = explode($separator, $number);
        $response = $numberParts[0];
        if (count($numberParts) > 1 && $precision > 0) {
            $response .= $separator;
            $response .= substr($numberParts[1], 0, $precision);
        }

        return $response;
    }
}
