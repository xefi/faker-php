<?php

namespace Xefi\Faker\Extensions;

class HashExtension extends Extension
{
    protected function hash(string $algo): string
    {
        return hash($algo, $this->randomizer->getBytes(16));
    }

    public function md5(): string
    {
        return $this->hash('md5');
    }

    public function sha1(): string
    {
        return $this->hash('sha1');
    }

    public function sha256(): string
    {
        return $this->hash('sha256');
    }

    public function sha512(): string
    {
        return $this->hash('sha512');
    }
}