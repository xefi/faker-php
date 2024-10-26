<?php

namespace Xefi\Faker\Extensions;

class NumbersExtension extends Extension
{
    public function digit(): int
    {
        return $this->number(0, 9);
    }

    public function number(int $min, int $max): int
    {
        return $this->randomizer->getInt($min, $max);
    }

    public function float(float $min, float $max, int $decimals = 1): float
    {
        if ($min === $max) {
            return (float) number_format($min, $decimals, '.', '');
        }

        $factor = pow(10, $decimals);
        $randomInt = $this->number((int) floor($min * $factor), (int) ceil($max * $factor));

        return (float) number_format($randomInt / $factor, $decimals, '.', '');
    }
}
