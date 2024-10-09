<?php

namespace Xefi\Faker\Extensions;

class ColorsExtension extends Extension
{
    protected array $safeColorNames = [
        'Black', 'Maroon', 'Green', 'Navy', 'Olive',
        'Purple', 'Teal', 'Lime', 'Blue', 'Silver',
        'Gray', 'Yellow', 'Fuchsia', 'Aqua', 'White',
    ];

    protected array $colorNames = [
        'AliceBlue', 'AntiqueWhite', 'Aqua', 'Aquamarine', 'Azure',
        'Beige', 'Bisque', 'Black', 'BlanchedAlmond', 'Blue',
        'BlueViolet', 'Brown', 'BurlyWood', 'CadetBlue', 'Chartreuse',
        'Chocolate', 'Coral', 'CornflowerBlue', 'Cornsilk', 'Crimson',
        'Cyan', 'DarkBlue', 'DarkCyan', 'DarkGoldenRod', 'DarkGray',
        'DarkGreen', 'DarkKhaki', 'DarkMagenta', 'DarkOliveGreen', 'Darkorange',
        'DarkOrchid', 'DarkRed', 'DarkSalmon', 'DarkSeaGreen', 'DarkSlateBlue',
        'DarkSlateGray', 'DarkTurquoise', 'DarkViolet', 'DeepPink', 'DeepSkyBlue',
        'DimGray', 'DimGrey', 'DodgerBlue', 'FireBrick', 'FloralWhite',
        'ForestGreen', 'Fuchsia', 'Gainsboro', 'GhostWhite', 'Gold',
        'GoldenRod', 'Gray', 'Green', 'GreenYellow', 'HoneyDew',
        'HotPink', 'IndianRed', 'Indigo', 'Ivory', 'Khaki',
        'Lavender', 'LavenderBlush', 'LawnGreen', 'LemonChiffon', 'LightBlue',
        'LightCoral', 'LightCyan', 'LightGoldenRodYellow', 'LightGray', 'LightGreen',
        'LightPink', 'LightSalmon', 'LightSeaGreen', 'LightSkyBlue', 'LightSlateGray',
        'LightSteelBlue', 'LightYellow', 'Lime', 'LimeGreen', 'Linen',
        'Magenta', 'Maroon', 'MediumAquaMarine', 'MediumBlue', 'MediumOrchid',
        'MediumPurple', 'MediumSeaGreen', 'MediumSlateBlue', 'MediumSpringGreen', 'MediumTurquoise',
        'MediumVioletRed', 'MidnightBlue', 'MintCream', 'MistyRose', 'Moccasin',
        'NavajoWhite', 'Navy', 'OldLace', 'Olive', 'OliveDrab',
        'Orange', 'OrangeRed', 'Orchid', 'PaleGoldenRod', 'PaleGreen',
        'PaleTurquoise', 'PaleVioletRed', 'PapayaWhip', 'PeachPuff', 'Peru',
        'Pink', 'Plum', 'PowderBlue', 'Purple', 'Red',
        'RosyBrown', 'RoyalBlue', 'SaddleBrown', 'Salmon', 'SandyBrown',
        'SeaGreen', 'SeaShell', 'Sienna', 'Silver', 'SkyBlue',
        'SlateBlue', 'SlateGray', 'Snow', 'SpringGreen', 'SteelBlue',
        'Tan', 'Teal', 'Thistle', 'Tomato', 'Turquoise',
        'Violet', 'Wheat', 'White', 'WhiteSmoke', 'Yellow',
        'YellowGreen',
    ];

    /**
     * @example 'blue'
     *
     * @return string
     */
    public function safeColorName(): string
    {
        return $this->pickArrayRandomElement($this->safeColorNames);
    }

    /**
     * @example 'Fuchsia'
     *
     * @return string
     */
    public function colorName(): string
    {
        return $this->pickArrayRandomElement($this->colorNames);
    }

    /**
     * @example '#aa5533'
     *
     * @return string
     */
    public function safeHexColor(): string
    {
        $rand = '';
        for ($i = 0; $i < 3; $i++) {
            $rand .= str_repeat(dechex($this->randomizer->getInt(0, 15)), 2);
        }

        return '#'.$rand;
    }

    /**
     * @example '#d67da0'
     *
     * @return string
     */
    public function hexColor(): string
    {
        return '#'.bin2hex($this->randomizer->getBytes(3));
    }

    /**
     * @example [0 => 31, 1 => 244, 2 => 208]
     *
     * @return array
     */
    public function rgbColorAsArray(): array
    {
        $colors = [];
        for ($i = 0; $i < 3; $i++) {
            $colors[] = $this->randomizer->getInt(0, 255);
        }

        return $colors;
    }

    /**
     * @example '237,147,91'
     *
     * @return string
     */
    public function rgbColor(): string
    {
        return implode(',', $this->rgbColorAsArray());
    }

    /**
     * @example 'rgb(213,75,159)'
     *
     * @return string
     */
    public function rgbCssColor(): string
    {
        return 'rgb('.$this->rgbColor().')';
    }

    /**
     * @example '[0 => 31, 1 => 244, 2 => 248, 3 => 0.81]'
     *
     * @return array
     */
    public function rgbaColorAsArray(): array
    {
        $colors = [];
        for ($i = 0; $i < 3; $i++) {
            $colors[] = $this->randomizer->getInt(0, 255);
        }

        $colors[] = round($this->randomizer->getFloat(0, 1), 2);

        return $colors;
    }

    /**
     * @example '164,75,242,0.96'
     *
     * @return string
     */
    public function rgbaColor(): string
    {
        return implode(',', $this->rgbaColorAsArray());
    }

    /**
     * @example 'rgba(155,242,48,0.61)'
     *
     * @return string
     */
    public function rgbaCssColor(): string
    {
        return 'rgba('.$this->rgbaColor().')';
    }

    /**
     * @example [0 => 31, 1 => 80, 2 => 50]
     *
     * @return array
     */
    public function hslColorAsArray(): array
    {
        $colors = [];

        $colors[] = $this->randomizer->getInt(0, 360); // Hue
        $colors[] = $this->randomizer->getInt(0, 100); // Saturation
        $colors[] = $this->randomizer->getInt(0, 100); // Lightness

        return $colors;
    }

    /**
     * @example '12,2,71'
     *
     * @return string
     */
    public function hslColor(): string
    {
        return implode(',', $this->hslColorAsArray());
    }

    /**
     * @example 'hsl(57,82,56)'
     *
     * @return string
     */
    public function hslCssColor(): string
    {
        return 'hsl('.$this->hslColor().')';
    }

    /**
     * @example [0 => 31, 1 => 80, 2 => 50, 3 => 0.07]
     *
     * @return array
     */
    public function hslaColorAsArray(): array
    {
        $colors = [];

        $colors[] = $this->randomizer->getInt(0, 360); // Hue
        $colors[] = $this->randomizer->getInt(0, 100); // Saturation
        $colors[] = $this->randomizer->getInt(0, 100); // Lightness
        $colors[] = round($this->randomizer->getFloat(0, 1), 2); // Alpha

        return $colors;
    }

    /**
     * @example '12,2,71,0.32'
     *
     * @return string
     */
    public function hslaColor(): string
    {
        return implode(',', $this->hslaColorAsArray());
    }

    /**
     * @example 'hsl(57,82,56,0.91)'
     *
     * @return string
     */
    public function hslaCssColor(): string
    {
        return 'hsla('.$this->hslaColor().')';
    }
}
