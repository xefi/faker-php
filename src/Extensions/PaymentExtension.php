<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\Extensions\Traits\HasLocale;

class PaymentExtension extends Extension
{
    use HasLocale;

    /**
     * @param string|null $countryCode
     * @param string|null $format [{d} => digit, {l} => letter, {a} => any]
     * @return string
     */
    public function iban(string $countryCode = null, string $format = null): string
    {
        if ($format === null) {
            $format = str_repeat('{d}', 24);
        }

        if ($countryCode === null) {
            $countryCode = $this->randomizer->getBytesFromString(implode(range('A', 'Z')), 2);
        }

        while (($pos = strpos($format, '{a}')) !== false) {
            $format = substr_replace($format, $this->pickArrayRandomElement(['{d}', '{l}']), $pos, 3);
        }

        while (($pos = strpos($format, '{d}')) !== false) {
            $format = substr_replace($format, (string)$this->randomizer->getInt(0, 9), $pos, 3);
        }

        while (($pos = strpos($format, '{l}')) !== false) {
            $format = substr_replace($format, $this->randomizer->getBytesFromString(implode(range('A', 'Z')), 1), $pos, 3);
        }

        $checksum = Iban::checksum($countryCode . '00' . $format);

        return $countryCode . $checksum . $format;
    }

}