<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class ColorsExtension extends Extension
{
    use HasLocale;

    protected array $safeColorNames = [
        'Niger', 'Castaneus', 'Viridis', 'Navalis', 'Oliva',
        'Purpureus', 'CaeruleusMarinus', 'Lima', 'Caeruleus', 'Argenteus',
        'Canus', 'Flavus', 'Fuchsia', 'Aqua', 'Albus',
    ];

    protected array $colorNames = [
        'Niger', 'Castaneus', 'Viridis', 'Navalis', 'Oliva',
        'Purpureus', 'CaeruleusMarinus', 'Lima', 'Caeruleus', 'Argenteus',
        'Canus', 'Flavus', 'Fuchsia', 'Aqua', 'Albus',
        'Beige', 'Chocolatum', 'Corallium', 'Cyanus', 'Crimsonus',
        'CaeruleusFuscus', 'AurantiacusFuscus', 'Latericius', 'ViridisMarinus', 'AlbusFloralis',
        'ViridisSilvestris', 'Aurum', 'Roseus', 'Indicum', 'Khaki',
        'Lavandula', 'CaeruleusLevis', 'CoralliumLeve', 'ViridisLevis', 'SalmoneusLevis',
        'Linum', 'Magenta', 'CaeruleusMedius', 'OrchisMedius', 'Mocassin',
        'Aurantiacus', 'Ruber', 'Prunum', 'Peruviana', 'CaeruleusRegius',
        'Salmoneus', 'FuscusArenosus', 'CaeruleusCaelum', 'Nix', 'Turcicus',
        'Violaceus', 'AlbusFumosus',
    ];

    public function safeColorName(): string
    {
        return $this->pickArrayRandomElement($this->safeColorNames);
    }

    public function colorName(): string
    {
        return $this->pickArrayRandomElement($this->colorNames);
    }

    public function safeHexColor(): string
    {
        $rand = '';
        for ($i = 0; $i < 3; $i++) {
            $rand .= str_repeat(dechex($this->randomizer->getInt(0, 15)), 2);
        }

        return '#'.$rand;
    }

    public function hexColor(): string
    {
        return '#'.bin2hex($this->randomizer->getBytes(3));
    }

    public function rgbColorAsArray(): array
    {
        $colors = [];
        for ($i = 0; $i < 3; $i++) {
            $colors[] = $this->randomizer->getInt(0, 255);
        }

        return $colors;
    }

    public function rgbColor(): string
    {
        return implode(',', $this->rgbColorAsArray());
    }

    public function rgbCssColor(): string
    {
        return 'rgb('.$this->rgbColor().')';
    }

    public function rgbaColorAsArray(): array
    {
        $colors = [];
        for ($i = 0; $i < 3; $i++) {
            $colors[] = $this->randomizer->getInt(0, 255);
        }

        $colors[] = round($this->randomizer->getFloat(0, 1), 2);

        return $colors;
    }

    public function rgbaColor(): string
    {
        return implode(',', $this->rgbaColorAsArray());
    }

    public function rgbaCssColor(): string
    {
        return 'rgba('.$this->rgbaColor().')';
    }

    public function hslColorAsArray(): array
    {
        $colors = [];

        $colors[] = $this->randomizer->getInt(0, 360); // Hue
        $colors[] = $this->randomizer->getInt(0, 100); // Saturation
        $colors[] = $this->randomizer->getInt(0, 100); // Lightness

        return $colors;
    }

    public function hslColor(): string
    {
        return implode(',', $this->hslColorAsArray());
    }

    public function hslCssColor(): string
    {
        return 'hsl('.$this->hslColor().')';
    }

    public function hslaColorAsArray(): array
    {
        $colors = [];

        $colors[] = $this->randomizer->getInt(0, 360); // Hue
        $colors[] = $this->randomizer->getInt(0, 100); // Saturation
        $colors[] = $this->randomizer->getInt(0, 100); // Lightness
        $colors[] = round($this->randomizer->getFloat(0, 1), 2); // Alpha

        return $colors;
    }

    public function hslaColor(): string
    {
        return implode(',', $this->hslaColorAsArray());
    }

    public function hslaCssColor(): string
    {
        return 'hsla('.$this->hslaColor().')';
    }
}
