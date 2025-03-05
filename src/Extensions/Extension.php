<?php

namespace Xefi\Faker\Extensions;

use Random\Randomizer;
use ReflectionClass;

class Extension
{
    protected Randomizer $randomizer;

    public function __construct(Randomizer $randomizer)
    {
        $this->randomizer = $randomizer;
    }

    /**
     * Returns the extension name.
     *
     * @return string
     */
    public function getName(): string
    {
        return
            // Here we convert the class name to kebab case
            strtolower(
                preg_replace(
                    '/([a-z])([A-Z])/',
                    '$1-$2',
                    (
                    new ReflectionClass($this))->getShortName()
                )
            );
    }

    /**
     * Return a given number of random elements from the given array.
     *
     * @param array $array
     * @param int   $elements
     *
     * @return array
     */
    protected function pickArrayRandomElements(array $array, int $elements = 1): array
    {
        $keys = $this->randomizer->pickArrayKeys($array, $elements);

        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Return a random element from the given array.
     *
     * @param array $array
     *
     * @return mixed
     */
    protected function pickArrayRandomElement(array $array): mixed
    {
        $elements = $this->pickArrayRandomElements($array);

        return reset($elements);
    }

    protected function pickArrayRandomKeys(array $array, int $elements = 1): array
    {
        return $this->randomizer->pickArrayKeys($array, $elements);
    }

    protected function pickArrayRandomKey(array $array): mixed
    {
        return key($array[$this->pickArrayRandomKeys($array)[0]]);
    }

    protected function formatString(string $string): string
    {
        while (($pos = strpos($string, '{a}')) !== false) {
            $string = substr_replace($string, $this->pickArrayRandomElement(['{d}', '{l}']), $pos, 3);
        }

        while (($pos = strpos($string, '{d}')) !== false) {
            $string = substr_replace($string, (string) $this->randomizer->getInt(0, 9), $pos, 3);
        }

        while (($pos = strpos($string, '{l}')) !== false) {
            $string = substr_replace($string, $this->randomizer->getBytesFromString(implode(range('A', 'Z')), 1), $pos, 3);
        }

        return $string;
    }
}
