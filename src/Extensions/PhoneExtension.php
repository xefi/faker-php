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

    public function phoneNumber($format = null, $separator = '', $prefix = null): string
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

    public function cellPhoneNumber($separator = '', $prefix = null): string
    {
        return $this->phoneNumber(format: $this->pickArrayRandomElement($this->cellFormats), separator: $separator, prefix: $prefix);
    }

    public function landlinePhoneNumber($separator = '', $prefix = null): string
    {
        return $this->phoneNumber(format: $this->pickArrayRandomElement($this->landlineFormats), separator: $separator, prefix: $prefix);
    }

    public function indicatoredPhoneNumber($format = null, $separator = ''): string
    {
        return $this->phoneNumber(format: $format, separator: $separator, prefix: $this->indicator);
    }

    public function indicatoredCellPhoneNumber($separator = ''): string
    {
        return $this->cellPhoneNumber(separator: $separator, prefix: $this->indicator);
    }

    public function indicatoredLandlinePhoneNumber($separator = ''): string
    {
        return $this->landlinePhoneNumber(separator: $separator, prefix: $this->indicator);
    }
}
