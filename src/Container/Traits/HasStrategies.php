<?php

namespace Xefi\Faker\Container\Traits;

use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Strategies\UniqueStrategy;

trait HasStrategies
{
    /**
     * The current instance strategies.
     *
     * @var array
     */
    protected array $strategies = [];

    /**
     * Add a unique strategy.
     *
     * @param string $seed
     * @param int    $maxRetries
     *
     * @return $this
     */
    public function unique(string $seed = '')
    {
        $this->strategies[] = UniqueStrategy::forSeed($seed);

        return $this;
    }

    /**
     * Add a regex strategy.
     *
     * @param string $regex
     *
     * @return $this
     */
    public function regex(string $regex)
    {
        $this->strategies[] = new RegexStrategy($regex);

        return $this;
    }

    /**
     * Determine if a generated value passes the strategies.
     *
     * @param $generatedValue
     *
     * @return bool
     */
    public function passStrategies($generatedValue): bool
    {
        foreach ($this->strategies as $strategy) {
            if (!$strategy->pass($generatedValue)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Reset the registered strategies.
     *
     * @return void
     */
    public function forgetStrategies(): void
    {
        $this->strategies = [];
    }

    /**
     * Returns the current strategies for the container.
     *
     * @return array
     */
    public function getStrategies(): array
    {
        return $this->strategies;
    }
}
