<?php

namespace Xefi\Faker\Strategies;

abstract class Strategy
{
    /**
     * Handle the given strategy.
     *
     * @return bool
     */
    abstract public function pass($generatedValue): bool;
}
