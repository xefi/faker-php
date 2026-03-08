<?php

namespace Xefi\Faker\Extensions\Traits;

use Xefi\Faker\Container\Enum\Locales;

trait HasLocale
{
    /**
     * The extension locale (BCP 47 Code).
     *
     * @return ?string
     */
    public function getLocale(): ?string
    {
        return Locales::DEFAULT;
    }
}
