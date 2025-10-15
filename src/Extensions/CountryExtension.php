<?php

namespace Xefi\Faker\Extensions;

class CountryExtension extends Extension
{
    protected array $countryName = [
        ['name' => 'France',          'code2' => 'FR', 'code3' => 'FRA'],
        ['name' => 'Spain',           'code2' => 'ES', 'code3' => 'ESP'],
        ['name' => 'Italy',           'code2' => 'IT', 'code3' => 'ITA'],
        ['name' => 'Germany',         'code2' => 'DE', 'code3' => 'DEU'],
        ['name' => 'United Kingdom',  'code2' => 'GB', 'code3' => 'GBR'],
        ['name' => 'United States',   'code2' => 'US', 'code3' => 'USA'],
        ['name' => 'Portugal',        'code2' => 'PT', 'code3' => 'PRT'],
        ['name' => 'Switzerland',     'code2' => 'CH', 'code3' => 'CHE'],
        ['name' => 'Belgium',         'code2' => 'BE', 'code3' => 'BEL'],
        ['name' => 'Netherlands',     'code2' => 'NL', 'code3' => 'NLD'],
    ];

    public function country(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['name'];
    }

    public function countryCodeISOAlpha2(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['code2'];
    }

    public function countryCodeISOAlpha3(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['code3'];
    }

}