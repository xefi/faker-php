<?php

namespace Xefi\Faker\Extensions;

class InternetExtension extends Extension
{
    protected $tld = ['com', 'biz', 'info', 'net', 'org', 'edu', 'gov', 'mil', 'co', 'io'];

    public function sdl(): string
    {
        return $this->randomizer->getBytesFromString(
            implode(range('a', 'z')),
            $this->randomizer->getInt(5, 10)
        );
    }

    public function tld(): string
    {
        return $this->pickArrayRandomElement($this->tld);
    }

    public function domain(): string
    {
        return sprintf('%s.%s', $this->sdl(), $this->tld());
    }

    public function ipv4(): string
    {
        return long2ip($this->randomizer->getInt(0, 1) === 0 ? $this->randomizer->getInt(-2147483648, -2) : $this->randomizer->getInt(16777216, 2147483647));
    }

    public function ipv6(): string
    {
        $res = [];

        for ($i = 0; $i < 8; $i++) {
            $res[] = dechex($this->randomizer->getInt(0, 65535));
        }

        return implode(':', $res);
    }

    public function macAddress()
    {
        return implode(':', str_split(substr(md5($this->randomizer->getInt(0, 2147483647)), 0, 12), 2));
    }
}
