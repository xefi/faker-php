<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\Container\Container;

final class StringsExtensionTest extends TestCase
{
    public function testLetter(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 26; $i++) {
            $results[] = $faker->unique()->letter();
        }

        $this->assertEqualsCanonicalizing(
            range('a', 'z'),
            $results
        );
    }

    public function testShuffleString(): void
    {
        $faker = new Container(false);

        $string = '!?@ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = $faker->shuffle($string);

        foreach (str_split($string) as $character) {
            $this->assertStringContainsString($character, $result);
        }
    }

    public function testShuffleArray(): void
    {
        $faker = new Container(false);

        $array = ['!', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $result = $faker->shuffle($array);

        foreach ($array as $character) {
            $this->assertContains($character, $result);
        }
    }

    public function testConvertCharacters(): void
    {
        $faker = new Container(false);

        $result = $faker->convertCharacters('NotConverted|#####|?????|*****');

        $result = explode('|', $result);

        $this->assertEquals('NotConverted', $result[0]);

        $this->assertTrue(ctype_digit($result[1]));

        $this->assertTrue(ctype_alpha($result[2]));

        $this->assertTrue(ctype_alnum($result[3]));
    }

    public function testSemVer(): void
    {
        $faker = new Container(false);

        // From: https://semver.org/spec/v2.0.0.html
        $regex = '/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/';

        $result = $faker->semver();

        $this->assertMatchesRegularExpression(
            $regex,
            $result
        );
    }

    public function testEmoji(): void
    {
        $faker = new Container(false);

        $result = $faker->emoji();

        $this->assertMatchesRegularExpression('/^\p{So}$/u', $result);
    }
}
