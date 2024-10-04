<?php

namespace Xefi\Faker\Extensions;

class NumbersExtension extends Extension
{
    public function digit(): int
    {
        return $this->numberBetween(0, 9);
    }

    public function numberBetween(int $min, int $max): int
    {
        return $this->randomizer->getInt($min, $max);
    }

    public function floatBetween(float $min, float $max): float
    {
        return $this->randomizer->getFloat($min, $max);
    }

    public function float(int $min, int $max, int $decimals = 1): float
    {
        return $this->numberBetween($min, $max) / max(10 * $decimals, 1);
    }
}
