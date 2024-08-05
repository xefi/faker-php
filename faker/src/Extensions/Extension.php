<?php

namespace Xefi\Faker\Extensions;

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
        return $this->name;
    }
}