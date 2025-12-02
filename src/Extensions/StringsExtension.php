<?php

namespace Xefi\Faker\Extensions;

use Random\RandomException;

class StringsExtension extends Extension
{
    protected $emojis = [
        "\u{1F600}", "\u{1F601}", "\u{1F602}", "\u{1F603}",
        "\u{1F604}", "\u{1F605}", "\u{1F606}", "\u{1F607}",
        "\u{1F608}", "\u{1F609}", "\u{1F60A}", "\u{1F60B}",
        "\u{1F60C}", "\u{1F60D}", "\u{1F60E}", "\u{1F60F}",
        "\u{1F610}", "\u{1F611}", "\u{1F612}", "\u{1F613}",
        "\u{1F614}", "\u{1F615}", "\u{1F616}", "\u{1F617}",
        "\u{1F618}", "\u{1F619}", "\u{1F61A}", "\u{1F61B}",
        "\u{1F61C}", "\u{1F61D}", "\u{1F61E}", "\u{1F61F}",
        "\u{1F620}", "\u{1F621}", "\u{1F622}", "\u{1F623}",
        "\u{1F624}", "\u{1F625}", "\u{1F626}", "\u{1F627}",
        "\u{1F628}", "\u{1F629}", "\u{1F62A}", "\u{1F62B}",
        "\u{1F62C}", "\u{1F62D}", "\u{1F62E}", "\u{1F62F}",
        "\u{1F630}", "\u{1F631}", "\u{1F632}", "\u{1F633}",
        "\u{1F634}", "\u{1F635}", "\u{1F636}", "\u{1F637}",
        "\u{1F638}", "\u{1F639}", "\u{1F63A}", "\u{1F63B}",
        "\u{1F63C}", "\u{1F63D}", "\u{1F63E}", "\u{1F63F}",
        "\u{1F640}", "\u{1F641}", "\u{1F642}", "\u{1F643}",
        "\u{1F644}", "\u{1F645}", "\u{1F646}", "\u{1F647}",
        "\u{1F648}", "\u{1F649}", "\u{1F64A}", "\u{1F64B}",
        "\u{1F64C}", "\u{1F64D}", "\u{1F64E}", "\u{1F64F}",
    ];

    public function letter()
    {
        return chr($this->randomizer->getInt(97, 122));
    }

    public function shuffle(array|string $needle): array|string
    {
        return $this->{'shuffle'.gettype($needle)}($needle);
    }

    public function shuffleString(string $needle): string
    {
        return $this->randomizer->shuffleBytes($needle);
    }

    public function shuffleArray(array $needle): array
    {
        return $this->randomizer->shuffleArray($needle);
    }

    public function convertCharacters(string $string): string
    {
        $patterns = [
            '#' => fn () => $this->randomizer->getInt(0, 9),
            '?' => fn () => $this->letter(),
        ];

        // Here we dynamically define the wildcard to take another option
        $patterns['*'] = fn () => $this->pickArrayRandomElement($patterns)();

        for ($i = 0; $i < strlen($string); $i++) {
            $string[$i] = isset($patterns[$string[$i]]) ? $patterns[$string[$i]]() : $string[$i];
        }

        return $string;
    }

    public function semver(): string
    {
        return sprintf(
            '%d.%d.%d',
            $this->randomizer->getInt(0, 9),
            $this->randomizer->getInt(0, 99),
            $this->randomizer->getInt(0, 99)
        );
    }

    public function emoji(): string
    {
        return $this->pickArrayRandomElement($this->emojis);
    }

    /**
     * @throws RandomException
     */
    public function uuid(): string
    {
        $uuid = '';

        for ($i = 0; $i < 32; $i++) {
            $uuid .= ($i == 12)
                ? '4'
                : (($i == 16)
                    ? $this->pickArrayRandomElement(['8', '9', 'a', 'b'])
                    : bin2hex(random_bytes(1))[0]);

            if (in_array($i, [7, 11, 15, 19])) {
                $uuid .= '-';
            }
        }

        return $uuid;
    }

    public function ulid(): string
    {
        $ulid = '';
        $time = round(microtime(true) * 1000);
        $ulidChar = [];

        // All these numbers are ASCII ranges.
        for ($i = 48; $i <= 90; $i++) {
            if (!($i >= 58 && $i <= 64) && !in_array($i, [73, 76, 79, 85])) {
                $ulidChar[] = chr($i);
            }
        }

        for ($i = 0; $i < 26; $i++) {
            if ($i < 10) {
                // 32 because ulid use base32 "Crockford"
                $ulid = $ulidChar[$time % 32].$ulid;
                $time = floor($time / 32);
            } else {
                $ulid .= $ulidChar[rand(0, 31)];
            }
        }

        return $ulid;
    }
}
