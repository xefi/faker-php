<?php

namespace Xefi\Faker\Extensions;

use ReflectionClass;

class Extension
{
    /**
     * Returns the extension name.
     *
     * @return string
     */
    public function getName(): string
    {
        return
            // Here we convert the class name to kebab case
            strtolower(
                preg_replace('/([a-z])([A-Z])/', '$1-$2', (
                    new ReflectionClass($this))->getShortName()
                )
            );
    }
}