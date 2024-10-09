<?php

namespace Xefi\Faker\Extensions\Traits;

trait HasLocale
{
    /**
     * The extension locale (BCP 47 Code).
     *
     * @return string | null
     */
    public function getLocale(): string|null
    {
        return null;
    }
}
