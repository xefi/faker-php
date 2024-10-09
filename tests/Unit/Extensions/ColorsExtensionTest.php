<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Extensions\ColorsExtension;

final class ColorsExtensionTest extends TestCase
{
    protected array $safeColorNames = [];
    protected array $colorNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $colorExtension = new ColorsExtension(new Randomizer());
        $this->safeColorNames = (new \ReflectionClass($colorExtension))->getProperty('safeColorNames')->getValue($colorExtension);
        $this->colorNames = (new \ReflectionClass($colorExtension))->getProperty('colorNames')->getValue($colorExtension);
    }

    public function testSafeColorName(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->safeColorNames); $i++) {
            $results[] = $faker->unique()->safeColorName();
        }

        $this->assertEqualsCanonicalizing(
            $this->safeColorNames,
            $results
        );
    }

    public function testColorName(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->colorNames); $i++) {
            $results[] = $faker->unique()->colorName();
        }

        $this->assertEqualsCanonicalizing(
            $this->colorNames,
            $results
        );
    }

    public function testSafeHexColor(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->safeHexColor();

            $this->assertStringStartsWith('#', $color);
            $this->assertTrue(ctype_xdigit(substr($color, 1)));
            $this->assertEquals(7, strlen($color));
        }
    }

    public function testHexColor(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hexColor();

            $this->assertStringStartsWith('#', $color);
            $this->assertTrue(ctype_xdigit(substr($color, 1)));
            $this->assertEquals(7, strlen($color));
        }
    }

    public function testRgbColorAsArray(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbColorAsArray();

            $this->assertCount(3, $color);

            // Red
            $this->assertGreaterThanOrEqual(0, $color[0]);
            $this->assertLessThanOrEqual(255, $color[0]);

            // Green
            $this->assertGreaterThanOrEqual(0, $color[1]);
            $this->assertLessThanOrEqual(255, $color[1]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $color[2]);
            $this->assertLessThanOrEqual(255, $color[2]);
        }
    }

    public function testRgbColor(): void
    {
        $faker = new Container(false);
        $regex = '/^(\d+),(\d+),(\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbColor();
            preg_match($regex, $color, $matches);

            /// Red
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(255, $matches[1]);

            // Green
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(255, $matches[2]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(255, $matches[3]);
        }
    }

    public function testRgbCssColor(): void
    {
        $faker = new Container(false);
        $regex = '/^rgb\((\d+),(\d+),(\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbCssColor();
            preg_match($regex, $color, $matches);

            // String
            $this->assertStringStartsWith('rgb(', $color);
            $this->assertStringEndsWith(')', $color);

            /// Red
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(255, $matches[1]);

            // Green
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(255, $matches[2]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(255, $matches[3]);
        }
    }

    public function testRgbaColorAsArray(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbaColorAsArray();

            $this->assertCount(4, $color);

            // Red
            $this->assertGreaterThanOrEqual(0, $color[0]);
            $this->assertLessThanOrEqual(255, $color[0]);

            // Green
            $this->assertGreaterThanOrEqual(0, $color[1]);
            $this->assertLessThanOrEqual(255, $color[1]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $color[2]);
            $this->assertLessThanOrEqual(255, $color[2]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $color[3]);
            $this->assertLessThanOrEqual(1, $color[3]);
        }
    }

    public function testRgbaColor(): void
    {
        $faker = new Container(false);
        $regex = '/^(\d+),(\d+),(\d+),([01]|0\.\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbaColor();
            preg_match($regex, $color, $matches);

            /// Red
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(255, $matches[1]);

            // Green
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(255, $matches[2]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(255, $matches[3]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $matches[4]);
            $this->assertLessThanOrEqual(1, $matches[4]);
        }
    }

    public function testRgbaCssColor(): void
    {
        $faker = new Container(false);
        $regex = '/^rgba\((\d+),(\d+),(\d+),([01]|0\.\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->rgbaCssColor();
            preg_match($regex, $color, $matches);

            // String
            $this->assertStringStartsWith('rgba(', $color);
            $this->assertStringEndsWith(')', $color);

            /// Red
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(255, $matches[1]);

            // Green
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(255, $matches[2]);

            // Blue
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(255, $matches[3]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $matches[4]);
            $this->assertLessThanOrEqual(1, $matches[4]);
        }
    }

    public function testHslColorAsArray(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslColorAsArray();

            $this->assertCount(3, $color);

            // HUE
            $this->assertGreaterThanOrEqual(0, $color[0]);
            $this->assertLessThanOrEqual(360, $color[0]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $color[1]);
            $this->assertLessThanOrEqual(100, $color[1]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $color[2]);
            $this->assertLessThanOrEqual(100, $color[2]);
        }
    }

    public function testHslColor(): void
    {
        $faker = new Container(false);
        $regex = '/^(\d+),(\d+),(\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslColor();
            preg_match($regex, $color, $matches);

            // HUE
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(360, $matches[1]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(100, $matches[2]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(100, $matches[3]);
        }
    }

    public function testHslCssColor(): void
    {
        $faker = new Container(false);
        $regex = '/^hsl\((\d+),(\d+),(\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslCssColor();

            preg_match($regex, $color, $matches);

            // String
            $this->assertStringStartsWith('hsl(', $color);
            $this->assertStringEndsWith(')', $color);

            // HUE
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(360, $matches[1]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(100, $matches[2]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(100, $matches[3]);
        }
    }

    public function testHslaColorAsArray(): void
    {
        $faker = new Container(false);

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslaColorAsArray();

            $this->assertIsArray($color);
            $this->assertCount(4, $color);

            // HUE
            $this->assertGreaterThanOrEqual(0, $color[0]);
            $this->assertLessThanOrEqual(360, $color[0]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $color[1]);
            $this->assertLessThanOrEqual(100, $color[1]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $color[2]);
            $this->assertLessThanOrEqual(100, $color[2]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $color[3]);
            $this->assertLessThanOrEqual(1, $color[3]);
        }
    }

    public function testHslaColor(): void
    {
        $faker = new Container(false);
        $regex = '/^(\d+),(\d+),(\d+),([01]|0\.\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslaColor();
            preg_match($regex, $color, $matches);

            // HUE
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(360, $matches[1]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(100, $matches[2]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(100, $matches[3]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $matches[4]);
            $this->assertLessThanOrEqual(1, $matches[4]);
        }
    }

    public function testHslaCssColor(): void
    {
        $faker = new Container(false);
        $regex = '/^hsla\((\d+),(\d+),(\d+),([01]|0\.\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $faker->unique()->hslaCssColor();
            preg_match($regex, $color, $matches);

            // HUE
            $this->assertGreaterThanOrEqual(0, $matches[1]);
            $this->assertLessThanOrEqual(360, $matches[1]);

            // Saturation
            $this->assertGreaterThanOrEqual(0, $matches[2]);
            $this->assertLessThanOrEqual(100, $matches[2]);

            // Lightness
            $this->assertGreaterThanOrEqual(0, $matches[3]);
            $this->assertLessThanOrEqual(100, $matches[3]);

            // Alpha
            $this->assertGreaterThanOrEqual(0, $matches[4]);
            $this->assertLessThanOrEqual(1, $matches[4]);
        }
    }
}
