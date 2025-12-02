<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class PhoneExtension extends Extension
{
    use HasLocale;

    public string $defaultPrefix = '';

    public string $indicator = '+00';

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

        if (is_null($prefix)) {
            $prefix = $this->defaultPrefix;
        }

        $format = $prefix.$format;

        while (($pos = strpos($format, '{separator}')) !== false) {
            $format = substr_replace($format, $separator, $pos, 11);
        }

        return $this->formatString($format);
    }

    public function indicatoredPhoneNumber(?string $format = null, string $separator = ''): string
    {
        return $this->phoneNumber(format: $format, separator: $separator, prefix: $this->indicator);
    }

    public function spacedPhoneNumber(?string $format = null, ?string $prefix = null): string
    {
        return $this->phoneNumber(format: $format, separator: ' ', prefix: $prefix);
    }

    public function spacedIndicatoredPhoneNumber(?string $format = null): string
    {
        return $this->indicatoredPhoneNumber(format: $format, separator: ' ');
    }

    public function dottedPhoneNumber(?string $format = null, ?string $prefix = null): string
    {
        return $this->phoneNumber(format: $format, separator: '.', prefix: $prefix);
    }

    public function dottedIndicatoredPhoneNumber(?string $format = null): string
    {
        return $this->indicatoredPhoneNumber(format: $format, separator: '.');
    }

    public function dashedPhoneNumber(?string $format = null, ?string $prefix = null): string
    {
        return $this->phoneNumber(format: $format, separator: '-', prefix: $prefix);
    }

    public function dashedIndicatoredPhoneNumber(?string $format = null): string
    {
        return $this->indicatoredPhoneNumber(format: $format, separator: '-');
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

    public function spacedCellPhoneNumber(?string $prefix = null): string
    {
        return $this->cellPhoneNumber(separator: ' ', prefix: $prefix);
    }

    public function spacedIndicatoredCellPhoneNumber(): string
    {
        return $this->spacedCellPhoneNumber(prefix: $this->indicator);
    }

    public function dottedCellPhoneNumber(?string $prefix = null): string
    {
        return $this->cellPhoneNumber(separator: '.', prefix: $prefix);
    }

    public function dottedIndicatoredCellPhoneNumber(): string
    {
        return $this->indicatoredCellPhoneNumber(separator: '.');
    }

    public function dashedCellPhoneNumber(?string $prefix = null): string
    {
        return $this->cellPhoneNumber(separator: '-', prefix: $prefix);
    }

    public function dashedIndicatoredCellPhoneNumber(): string
    {
        return $this->indicatoredCellPhoneNumber(separator: '-');
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

    public function spacedLandlinePhoneNumber(?string $prefix = null): string
    {
        return $this->landlinePhoneNumber(separator: ' ', prefix: $prefix);
    }

    public function spacedIndicatoredLandlinePhoneNumber(): string
    {
        return $this->spacedLandlinePhoneNumber(prefix: $this->indicator);
    }

    public function dottedLandlinePhoneNumber(?string $prefix = null): string
    {
        return $this->landlinePhoneNumber(separator: '.', prefix: $prefix);
    }

    public function dottedIndicatoredLandlinePhoneNumber(): string
    {
        return $this->indicatoredLandlinePhoneNumber(separator: '.');
    }

    public function dashedLandlinePhoneNumber(?string $prefix = null): string
    {
        return $this->landlinePhoneNumber(separator: '-', prefix: $prefix);
    }

    public function dashedIndicatoredLandlinePhoneNumber(): string
    {
        return $this->indicatoredLandlinePhoneNumber(separator: '-');
    }
}
