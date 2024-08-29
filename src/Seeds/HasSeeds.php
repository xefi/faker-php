<?php

namespace Xefi\Faker\Seeds;

trait HasSeeds
{
    protected static array $seeds = [];

    /**
     * Get or create an instance for the given seed.
     *
     * @param string $seed
     *
     * @return static
     */
    public static function forSeed(string $seed, ...$parameters): static
    {
        return static::$seeds[$seed] ??= new static(...$parameters);
    }

    /**
     * Forget all the registered seeds.
     *
     * @return void
     */
    public function forgetSeeds()
    {
        static::$seeds = [];
    }
}
