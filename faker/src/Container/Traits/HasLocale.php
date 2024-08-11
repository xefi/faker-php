<?php

namespace Xefi\Faker\Container\Traits;

trait HasLocale
{
    /**
     * The current locale format (BCP 47 Code)
     *
     * @var string
     */
    protected string $locale;

    /**
     * Get the current locale
     *
     * @return string
     */
    public function getLocale(): string {
        return $this->locale ?? 'en-US';
    }

    /**
     * Change the locale
     *
     * @param string $locale
     * @return self
     */
    public function locale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}