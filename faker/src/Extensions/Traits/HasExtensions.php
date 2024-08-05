<?php

namespace Xefi\Faker\Extensions\Traits;

use Xefi\Faker\Container;
use Xefi\Faker\Extensions\Extension;

trait HasExtensions
{
    /**
     * The faker extensions
     *
     * @var array
     */
    protected static array $extensions;

    /**
     * Resolve an array of extensions through the container.
     *
     * @param  array  $extensions
     * @return $this
     */
    public function resolveExtensions(array $extensions)
    {
        foreach ($extensions as $command) {
            $this->resolve($command);
        }

        return $this;
    }

    /**
     * Add an extension, resolving through the application.
     *
     * @param  \Xefi\Faker\Extensions\Extension|string  $extension
     * @return \Xefi\Faker\Extensions\Extension
     */
    public function resolve(\Xefi\Faker\Extensions\Extension|string $extension): Container
    {
        if ($extension instanceof Extension) {
            return $this->addExtension($extension);
        }

        return $this->addExtension(new $extension);
    }

    /**
     * Add an extension to the container.
     *
     * @param  \Xefi\Faker\Extensions\Extension  $extension
     * @return \Xefi\Faker\Extensions\Extension
     */
    public function addExtension(Extension $extension): Container
    {
        self::$extensions[$extension->getName()] = $extension;

        return $this;
    }

    /**
     * Get the container extensions.
     *
     * @return array
     */
    public function getExtensions(): array
    {
        return self::$extensions;
    }
}