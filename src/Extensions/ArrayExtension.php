<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class ArrayExtension extends Extension
{
    use HasLocale;

    public function randomElement(array $array): mixed
    {
        return $this->pickArrayRandomElement($array);
    }

    public function randomKey(array $array): mixed
    {
        return $this->pickArrayRandomKey($array);
    }

    public function randomKeyNumber(array $array): mixed
    {
        return $this->pickArrayRandomKeyNumber($array);
    }
}
