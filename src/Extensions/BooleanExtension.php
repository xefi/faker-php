<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Exceptions\BadParameterException;
use Xefi\Faker\Extensions\Traits\HasLocale;

class BooleanExtension extends Extension
{
    use HasLocale;

    public function boolean(int $percentage = 50) {
        if ($percentage < 0 || $percentage > 100) {
            throw new BadParameterException('Percentage must be between 0 and 100');
        }

        $randomValue = $this->randomizer->getInt(1, 100);

        return $randomValue <= $percentage;
    }
}