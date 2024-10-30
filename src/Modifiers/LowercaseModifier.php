<?php

namespace Xefi\Faker\Modifiers;

class LowercaseModifier extends Modifier
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
            return strtolower($generatedValue);
        }

        return $generatedValue;
    }
}
