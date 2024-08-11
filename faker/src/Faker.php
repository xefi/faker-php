<?php

namespace Xefi\Faker;

use Xefi\Faker\Container\Container;
use Xefi\Faker\Container\Traits\HasLocale;

/**
 * @mixin Container
 */
class Faker
{
    /**
     * The current locale format (BCP 47 Code)
     *
     * @var string
     */
    protected string $locale;

    public function __construct(string $locale = 'en-US')
    {
        $this->locale = $locale;
    }

    public function __call(string $method, array $parameters)
    {
        // We simply redirect calls to container to create a new container for each faker call
        return (new Container)->locale($this->locale)->{$method}(...$parameters);
    }
}