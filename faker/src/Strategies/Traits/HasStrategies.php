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
}