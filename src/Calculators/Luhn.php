<?php

namespace Xefi\Faker\Calculators;

class Luhn
{
    /**
     * Luhn core algorithm.
     *
     * @param int $number
     *
     * @return int
     */
    private static function algorithm(int $number): int
    {
        $sum = 0;
        $parity = 1;
        settype($number, 'string');
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $factor = $parity ? 2 : 1;
            $parity = $parity ? 0 : 1;
            $sum += array_sum(str_split($number[$i] * $factor));
        }

        return $sum;
    }

    /**
     * Compute check digit.
     *
     * @param int $number Number to compute.
     *
     * @return int
     */
    public static function checksum(int $number): int
    {
        return (self::algorithm($number) * 9) % 10;
    }

    /**
     * Validate number containing check digit.
     *
     * @param int $number Number to validate.
     *
     * @return bool
     */
    public static function isValid(int $number): bool
    {
        return (self::algorithm($number.'0') % 10) === 0;
    }

    /**
     * Add check digit to number.
     *
     * @param int  $number Number to checksum.
     * @param bool $soft   Do not add check digit if number already validates.
     *
     * @return int
     */
    public static function create(int $number, bool $soft = false): int
    {
        return !self::isValid($number) || !$soft
            ? $number.self::checksum($number)
            : $number;
    }
}
