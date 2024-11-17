<?php

namespace Xefi\Faker\Modifiers;

class UppercaseModifier extends Modifier
{
    /**
     * Handle the given modifier.
     *
     * @param mixed $generatedValue
     *
     * @return mixed
     */
    public function apply(mixed $generatedValue): mixed
    {
        if (is_string($generatedValue)) {
            return strtoupper($generatedValue);
        }

        return $generatedValue;
    }
}
