<?php

namespace Xefi\Faker\Strategies;

use Xefi\Faker\Seeds\HasSeeds;

class UniqueStrategy extends Strategy
{
    use HasSeeds;

    /**
     * The values already drawn, keyed by their serialized form.
     *
     * @var array<string, true>
     */
    protected array $tried = [];

    /**
     * Handle the given strategy.
     *
     * @param mixed $generatedValue
     *
     * @return bool
     */
    public function pass(mixed $generatedValue): bool
    {
        // A serialized key gives a constant-time lookup where in_array() scanned every value drawn so
        // far, and keeps its strictness: 1, 1.0 and '1' serialize differently and stay distinct.
        $key = serialize($generatedValue);

        if (isset($this->tried[$key])) {
            return false;
        }

        $this->tried[$key] = true;

        return true;
    }
}
