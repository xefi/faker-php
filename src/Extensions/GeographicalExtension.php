<?php

namespace Xefi\Faker\Extensions;

class GeographicalExtension extends Extension
{
    public function geoLocation(): string
    {
        return sprintf(
            '%s, %s',
            $this->latitude(),
            $this->longitude(),
        );
    }

    public function latitude(): float
    {
        return round($this->randomizer->getFloat(-90, 90), 8);
    }

    public function longitude(): float
    {
        return round($this->randomizer->getFloat(-180, 180), 8);
    }
}