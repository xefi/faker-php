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
        $results = [];
        for ($i = 0; $i < count($this->safeColorNames); $i++) {
            $results[] = $this->faker->unique()->safeColorName();
        }

        $this->assertEqualsCanonicalizing(
            $this->safeColorNames,
            $results
        );
    }

    public function testColorName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->colorNames); $i++) {
            $results[] = $this->faker->unique()->colorName();
        }

        $this->assertEqualsCanonicalizing(
            $this->colorNames,
            $results
        );
    }

    public function testSafeHexColor(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->safeHexColor();

            $this->assertStringStartsWith('#', $color);
            $this->assertTrue(ctype_xdigit(substr($color, 1)));
            $this->assertEquals(7, strlen($color));
        }
    }

    public function testHexColor(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hexColor();

            $this->assertStringStartsWith('#', $color);
            $this->assertTrue(ctype_xdigit(substr($color, 1)));
            $this->assertEquals(7, strlen($color));
        }
    }

    public function testRgbColorAsArray(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbColorAsArray();

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
    {$regex = '/^(\d+),(\d+),(\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbColor();
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
    {$regex = '/^rgb\((\d+),(\d+),(\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbCssColor();
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
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbaColorAsArray();

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
    {$regex = '/^(\d+),(\d+),(\d+),([01]|0\.\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbaColor();
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
    {$regex = '/^rgba\((\d+),(\d+),(\d+),([01]|0\.\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->rgbaCssColor();
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
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslColorAsArray();

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
    {$regex = '/^(\d+),(\d+),(\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslColor();
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
    {$regex = '/^hsl\((\d+),(\d+),(\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslCssColor();

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
        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslaColorAsArray();

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
    {$regex = '/^(\d+),(\d+),(\d+),([01]|0\.\d+)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslaColor();
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
    {$regex = '/^hsla\((\d+),(\d+),(\d+),([01]|0\.\d+)\)$/';

        for ($i = 0; $i < 100; $i++) {
            $color = $this->faker->unique()->hslaCssColor();
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
