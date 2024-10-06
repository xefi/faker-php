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

    protected function pickArrayRandomElements(array $array, int $elements = 1)
    {
        $keys = $this->randomizer->pickArrayKeys($array, $elements);

        return array_intersect_key($array, array_flip($keys));
    }

    protected function pickArrayRandomElement(array $array)
    {
        $elements = $this->pickArrayRandomElements($array);

        return reset($elements);
    }

    protected function pickArrayRandomKeys(array $array, int $elements = 1)
    {
        return $this->randomizer->pickArrayKeys($array, $elements);
    }

    protected function pickArrayRandomKey(array $array)
    {
        $elements = $this->pickArrayRandomKeys($array);

        return reset($elements);
    }
}
