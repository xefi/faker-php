<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\Extensions\Traits\HasLocale;

class FinancialExtension extends Extension
{
    use HasLocale;

    /**
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($format === null) {
            $format = str_repeat('{d}', 24);
        }

        if ($countryCode === null) {
            $countryCode = $this->randomizer->getBytesFromString(implode(range('A', 'Z')), 2);
        }

        $format = $this->formatString($format);

        $checksum = Iban::checksum($countryCode.'00'.$format);

        return $countryCode.$checksum.$format;
    }
}
