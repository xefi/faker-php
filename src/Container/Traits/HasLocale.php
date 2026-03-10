<?php

namespace Xefi\Faker\Container\Traits;

use Xefi\Faker\Container\Enum\Locales;

trait HasLocale
{
    /**
     * The current locale format (BCP 47 Code).
     *
     * @var ?string
     */
    protected ?string $locale;

    /**
     * Get the current locale.
     *
     * @return ?string
     */
    public function getLocale(): ?string
    {
        return $this->locale ?? Locales::DEFAULT;
    }

    /**
     * Change the locale.
     *
     * @param ?string $locale
     *
     * @return self
     */
    public function locale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
