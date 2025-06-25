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
            if (function_exists('mb_strtoupper')) {
                return mb_strtoupper($generatedValue);
            }

            trigger_error('You do not have the `mbstring` extension enabled; FakerPHP might not handle uncommon characters correctly.', E_USER_WARNING);

            return strtoupper($generatedValue);
        }

        return $generatedValue;
    }
}
