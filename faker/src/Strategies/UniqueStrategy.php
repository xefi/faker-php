<?php

namespace Xefi\Faker\Strategies;

use Closure;

class UniqueStrategy extends Strategy
{
    protected array $tries = [];

    /**
     * Handle the given strategy
     *
     * @return mixed
     */
    public function handle(Closure $callback)
    {
        do {
            $generatedValue = $callback();

            $this->tries[] = $generatedValue;
        } while (in_array($generatedValue, $this->tries, true));

        return $generatedValue;
    }
}