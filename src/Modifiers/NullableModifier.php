<?php

namespace Xefi\Faker\Modifiers;

use Random\Randomizer;

class NullableModifier extends Modifier
{
    /**
     * The weight for null to be given (60 => 60% chance of null).
     *
     * @var int
     */
    protected int $weight;

    protected Randomizer $randomizer;

    public function __construct(Randomizer $randomizer, int $weight = 50)
    {
        $this->randomizer = $randomizer;
        $this->weight = max(0, min(100, $weight));
    }

    /**
     * Handle the given modifier.
     *
     * @param mixed $generatedValue
     *
     * @return mixed
     */
    public function apply(mixed $generatedValue): mixed
    {
        if ($this->randomizer->getInt(1, 100) <= $this->weight) {
            return null;
        }

        return $generatedValue;
    }
}
