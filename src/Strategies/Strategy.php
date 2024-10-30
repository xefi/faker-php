<?php

namespace Xefi\Faker\Strategies;

abstract class Strategy
{
    /**
     * Handle the given strategy.
     *
     * @param mixed $generatedValue
     * @return bool
     */
    abstract public function pass(mixed $generatedValue): bool;
}
