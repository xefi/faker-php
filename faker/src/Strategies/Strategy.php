<?php

namespace Xefi\Faker\Strategies;

use Closure;

abstract class Strategy
{
    /**
     * Handle the given strategy
     *
     * @return mixed
     */
    abstract public function handle(Closure $callback);
}