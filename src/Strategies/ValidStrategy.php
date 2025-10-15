<?php

namespace Xefi\Faker\Strategies;

class ValidStrategy extends Strategy
{
    protected object $callable;

    /**
     * @throws \ReflectionException
     * @throws \ErrorException
     */
    public function __construct(object $callable)
    {
        if (!is_callable($callable)) {
            throw new \ErrorException('The callable must be a callable');
        }

        if (count((new \ReflectionFunction($callable))->getParameters()) != 1) {
            throw new \ErrorException('The callable must have 1 parameter');
        }

        if (!is_bool($callable(5))) {
            throw new \ErrorException('The callable must return a value of type bool');
        }
        $this->callable = $callable;
    }

    /**
     * Handle the given strategy.
     *
     * @param mixed $generatedValue
     *
     * @return object
     */
    public function pass(mixed $generatedValue): bool
    {
        return ($this->callable)($generatedValue);
    }
}