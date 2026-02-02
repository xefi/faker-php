<?php

namespace Xefi\Faker\Modifiers;

class UcfirstModifier extends Modifier
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
            if (function_exists('mb_ucfirst')) {
                return mb_ucfirst($generatedValue);
            }

            trigger_error('You do not have the `mbstring` extension enabled; FakerPHP might not handle uncommon characters correctly.', E_USER_WARNING);

            return ucfirst($generatedValue);
        }

        return $generatedValue;
    }
}
