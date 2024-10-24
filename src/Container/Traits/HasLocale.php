<?php

namespace Xefi\Faker\Container\Traits;

trait HasLocale
{
    /**
     * The current locale format (BCP 47 Code).
     *
     * @var string
     */
    protected string|null $locale;

    /**
     * Get the current locale.
     *
     * @return string|null
     */
    public function getLocale(): string|null
    {
        return $this->locale ?? null;
    }

    /**
     * Change the locale.
     *
     * @param string|null $locale
     *
     * @return self
     */
    public function locale(string|null $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
