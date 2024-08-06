<?php

namespace Xefi\Faker;

/**
 * @mixin Container
 */
class Faker
{
    public function __call(string $method, array $parameters)
    {
        return (new Container)->{$method}(...$parameters);
    }
}