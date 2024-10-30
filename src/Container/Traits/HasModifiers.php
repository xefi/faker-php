<?php

namespace Xefi\Faker\Container\Traits;

use Random\Randomizer;
use Xefi\Faker\Modifiers\LowercaseModifier;
use Xefi\Faker\Modifiers\Modifier;
use Xefi\Faker\Modifiers\NullableModifier;
use Xefi\Faker\Modifiers\UppercaseModifier;
use Xefi\Faker\Strategies\RegexStrategy;
use Xefi\Faker\Strategies\UniqueStrategy;

trait HasModifiers
{
    /**
     * The current instance modifiers.
     *
     * @var Modifier[]
     */
    protected array $modifiers = [];

    /**
     * Add a nullable modifier.
     *
     * @param int $weight
     *
     * @return $this
     */
    public function nullable(int $weight = 50): self
    {
        $this->modifiers[] = new NullableModifier(new Randomizer, $weight);

        return $this;
    }

    /**
     * Add a uppercase modifier.
     **
     * @return $this
     */
    public function uppercase(): self
    {
        $this->modifiers[] = new UppercaseModifier();

        return $this;
    }

    /**
     * Add a lowercase modifier.
     **
     * @return $this
     */
    public function lowercase(): self
    {
        $this->modifiers[] = new LowercaseModifier();

        return $this;
    }

    /**
     * Determine if a generated value passes the strategies.
     *
     * @param $generatedValue
     *
     * @return mixed
     */
    public function applyModifiers($generatedValue): mixed
    {
        foreach ($this->getModifiers() as $modifier) {
            $generatedValue = $modifier->apply($generatedValue);
        }

        return $generatedValue;
    }

    /**
     * Reset the registered modifiers.
     *
     * @return void
     */
    public function forgetModifiers(): void
    {
        $this->modifiers = [];
    }

    /**
     * Returns the current modifiers for the container.
     *
     * @return array
     */
    public function getModifiers(): array
    {
        return $this->modifiers;
    }
}
