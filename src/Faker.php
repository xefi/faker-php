<?php

namespace Xefi\Faker;

use Random\Engine;
use Xefi\Faker\Container\Container;

/**
 * @mixin Container
 */
class Faker
{
    /**
     * The current locale format (BCP 47 Code).
     *
     * @var ?string
     */
    protected ?string $locale;

    /**
     * The current Randomizer engine.
     *
     * @var Engine|null
     */
    protected ?Engine $engine;

    public function __construct(?string $locale = null, ?Engine $engine = null)
    {
        $this->locale = $locale;
        $this->engine = $engine;
    }

    public function __call(string $method, array $parameters)
    {
        // We simply redirect calls to container to create a new container for each faker call
        return (new Container($this->engine))->locale($this->locale)->{$method}(...$parameters);
    }
}
