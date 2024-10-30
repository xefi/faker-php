<?php

namespace Xefi\Faker\Strategies;

use Xefi\Faker\Seeds\HasSeeds;

class UniqueStrategy extends Strategy
{
    use HasSeeds;

    /**
     * The element already tried.
     *
     * @var array
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
        if (in_array($generatedValue, $this->tried, true)) {
            return false;
        }

        $this->tried[] = $generatedValue;

        return true;
    }
}
