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
        return long2ip($this->randomizer->getInt(0, PHP_INT_MAX));
    }

    public function ipv6(): string
    {
        return inet_ntop($this->randomizer->getBytes(16));
    }

    public function macAddress()
    {
        return implode(':', str_split(substr(md5($this->randomizer->getInt(0, 2147483647)), 0, 12), 2));
    }
}
