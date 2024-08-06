<?php

namespace Xefi\Faker\Strategies\Traits;

use Xefi\Faker\Strategies\UniqueStrategy;

trait HasStrategies
{
    /**
     * The current instance strategies
     *
     * @var array
     */
    protected array $strategies;

    public function unique() {
        $this->strategies[] = new UniqueStrategy;

        return $this;
    }

    /**
     * Determine if a generated value passes the strategies
     *
     * @param $generatedValue
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
     * Reset the registered strategies
     *
     * @return void
     */
    public function forgetStrategies(): void
    {
        $this->strategies = [];
    }
}