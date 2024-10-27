<?php

namespace Xefi\Faker\Strategies;

class RegexStrategy extends Strategy
{
    protected string $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    /**
     * Handle the given strategy.
     *
     * @param $generatedValue
     *
     * @return bool
     */
    public function pass($generatedValue): bool
    {
        return (bool) preg_match($this->regex, $generatedValue);
    }
}
