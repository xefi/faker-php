<?php

namespace Xefi\Faker\Extensions;

use ReflectionClass;

class Extension
{
    protected string $name;

    /**
     * Returns the extension name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name ??
            // Here we convert the class name to kebab case
            strtolower(
                preg_replace('/([a-z])([A-Z])/', '$1-$2', (
                    new ReflectionClass($this))->getShortName()
                )
            );
    }
}