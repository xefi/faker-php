<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class PhoneExtension extends Extension
{
    use HasLocale;

    public string $defaultPrefix = '';

    public string $indicator = '00';

    protected array $landlineFormats = [
        '{d}{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '{d}{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];

    protected array $cellFormats = [
        '{d}{d}{separator}{d}{d}',
    ];

    // Global phone number
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if (!$format) {
            $format = $this->pickArrayRandomElement(rand(0, 1) ? $this->landlineFormats : $this->cellFormats);
        }

        while (($pos = strpos($format, '{separator}')) !== false) {
            $format = substr_replace($format, $separator, $pos, 11);
        }

        if (is_null($prefix)) {
            $prefix = $this->defaultPrefix;
        }

        return $prefix.$this->formatString($format);
    }

    public function indicatoredPhoneNumber(?string $format = null, string $separator = ''): string
    {
        return $this->phoneNumber(format: $format, separator: $separator, prefix: $this->indicator);
    }

    // Cell phone numbers
    public function cellPhoneNumber(string $separator = '', ?string $prefix = null): string
    {
        return $this->phoneNumber(format: $this->pickArrayRandomElement($this->cellFormats), separator: $separator, prefix: $prefix);
    }

    public function indicatoredCellPhoneNumber(string $separator = ''): string
    {
        return $this->cellPhoneNumber(separator: $separator, prefix: $this->indicator);
    }

    // Landline phone numbers
    public function landlinePhoneNumber(string $separator = '', ?string $prefix = null): string
    {
        return $this->phoneNumber(format: $this->pickArrayRandomElement($this->landlineFormats), separator: $separator, prefix: $prefix);
    }

    public function indicatoredLandlinePhoneNumber(string $separator = ''): string
    {
        return $this->landlinePhoneNumber(separator: $separator, prefix: $this->indicator);
    }
}
