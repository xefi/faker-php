<?php

namespace Xefi\Faker\Container\Traits;

use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Strategies\Strategy;
use Xefi\Faker\Strategies\UniqueStrategy;
use Xefi\Faker\Strategies\ValidStrategy;

trait HasStrategies
{
    /**
     * The current instance strategies.
     *
     * @var Strategy[]
     */
    protected array $strategies = [];

    /**
     * Add a unique strategy.
     *
     * @param string $seed
     *
     * @return $this
     */
    public function unique(string $seed = ''): self
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
    public function regex(string $regex): self
    {
        $this->strategies[] = new RegexStrategy($regex);

        return $this;
    }

    /**
     * Add a valid strategy.
     *
     * @param object $callable
     *
     *@throws \ErrorException
     *
     * @return $this
     */
    public function valid(object $callable): self
    {
        $this->strategies[] = new ValidStrategy($callable);

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
        foreach ($this->getStrategies() as $strategy) {
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
