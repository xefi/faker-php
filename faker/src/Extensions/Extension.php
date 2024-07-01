<?php

namespace Xefi\Faker\Extensions;

class Extension
{
    private string $name;

    /**
     * Returns the extension name.
     */
    public function getName(): string
    {
        return $this->name;
    }
}