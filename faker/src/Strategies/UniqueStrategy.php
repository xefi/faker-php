<?php

namespace Xefi\Faker\Strategies;

use Closure;

class UniqueStrategy extends Strategy
{
    protected array $tries = [];

    /**
     * Handle the given strategy
     *
     * @return bool
     */
    public function pass($generatedValue): bool
    {
        if (in_array($generatedValue, $this->tries, true)) {
            return false;
        }

        $this->tries[] = $generatedValue;
        return true;
    }
}