<?php

namespace Xefi\Faker\Extensions;

class CountryExtension extends Extension
{
    protected array $countryName = [
        ['name' => 'France',          'iso_country_code_alpha2' => 'FR', 'iso_country_code_alpha3' => 'FRA'],
        ['name' => 'Spain',           'iso_country_code_alpha2' => 'ES', 'iso_country_code_alpha3' => 'ESP'],
        ['name' => 'Italy',           'iso_country_code_alpha2' => 'IT', 'iso_country_code_alpha3' => 'ITA'],
        ['name' => 'Germany',         'iso_country_code_alpha2' => 'DE', 'iso_country_code_alpha3' => 'DEU'],
        ['name' => 'United Kingdom',  'iso_country_code_alpha2' => 'GB', 'iso_country_code_alpha3' => 'GBR'],
        ['name' => 'United States',   'iso_country_code_alpha2' => 'US', 'iso_country_code_alpha3' => 'USA'],
        ['name' => 'Portugal',        'iso_country_code_alpha2' => 'PT', 'iso_country_code_alpha3' => 'PRT'],
        ['name' => 'Switzerland',     'iso_country_code_alpha2' => 'CH', 'iso_country_code_alpha3' => 'CHE'],
        ['name' => 'Belgium',         'iso_country_code_alpha2' => 'BE', 'iso_country_code_alpha3' => 'BEL'],
        ['name' => 'Netherlands',     'iso_country_code_alpha2' => 'NL', 'iso_country_code_alpha3' => 'NLD'],
    ];

    /**
     * Returns a random country.
     */
    public function country(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['name'];
    }

    /**
     * Returns the country code in ISO format 3166-1 alpha-2 (FR, NL, US).
     */
    public function countryCodeISOAlpha2(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['iso_country_code_alpha2'];
    }

    /**
     * Returns the country code in ISO format 3166-1 alpha-3 (FRA, NLD, USA).
     */
    public function countryCodeISOAlpha3(): string
    {
        return $this->pickArrayRandomElement($this->countryName)['iso_country_code_alpha3'];
    }
}