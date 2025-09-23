<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class PhoneExtension extends Extension
{
    use HasLocale;

    protected array $formats = [
        '+{d}{d}{d}{d}{d}{d}{d}{d}{d}',
        '0{d}{d}{d}{d}{d}{d}{d}{d}{d}',
        '{d}{d}{d}'
    ];

    public function phoneNumber($format = null): string
    {
        if (!$format) {
            $format = $this->pickArrayRandomElement($this->formats);
        }

        return $this->formatString($format);
    }
}