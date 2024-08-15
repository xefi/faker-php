<?php

namespace Xefi\Faker\Strategies;

use Closure;

abstract class Strategy
{
    /**
     * Handle the given strategy
     *
     * @return bool
     */
    abstract public function pass($generatedValue): bool;
}