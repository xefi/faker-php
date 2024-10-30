<?php

namespace Xefi\Faker\Modifiers;

abstract class Modifier
{
    /**
     * Handle the given modifier.
     *
     * @param mixed $generatedValue
     * @return mixed
     */
    abstract public function apply(mixed $generatedValue): mixed;
}