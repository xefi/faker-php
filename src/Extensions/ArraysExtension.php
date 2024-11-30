<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class ArraysExtension extends Extension
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
}
