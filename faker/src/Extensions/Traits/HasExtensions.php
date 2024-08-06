<?php

namespace Xefi\Faker\Extensions\Traits;

use http\Exception\RuntimeException;
use Xefi\Faker\Container;
use Xefi\Faker\Extensions\Extension;

trait HasExtensions
{
    /**
     * The faker extensions
     *
     * @var array
     */
    protected static array $extensions = [];

    /**
     * The extensions methods linked to extension name
     *
     * @var array
     */
    protected static array $extensionsMethods;

    /**
     * Resolve an array of extensions through the container.
     *
     * @param  array  $extensions
     * @return $this
     */
    public function resolveExtensions(array $extensions)
    {
        foreach ($extensions as $extension) {
            $this->resolve($extension);
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
        if (isset(static::$extensions[$extension->getName()])) {
            trigger_error(sprintf('[XEFI FAKER] The %s extension is already registered', $extension->getName()), E_USER_WARNING);
        }

        static::$extensions[$extension->getName()] = $extension;

        // Here we register all the extensions methods in order to have a quick access after
        foreach (get_class_methods($extension) as $method) {
            // If the method is common
            if (in_array($method, ['getName', '__construct'])) {
                continue;
            }

            if (isset(static::$extensionsMethods[$method])) {
                trigger_error(sprintf('[XEFI FAKER] The %s method from %s is already registered', $method, $extension->getName()), E_USER_WARNING);
            }

            static::$extensionsMethods[$method] = $extension->getName();
        }

        return $this;
    }

    /**
     * Get the container extensions.
     *
     * @return array
     */
    public function getExtensions(): array
    {
        return static::$extensions;
    }

    /**
     * See if the extensions has already been set
     *
     * @return bool
     */
    public function areExtensionsInitialized(): bool
    {
        return !empty(static::$extensions);
    }

    /**
     * Reset the container extensions.
     *
     * @return void
     */
    public function forgetExtensions(): void
    {
        static::$extensions = [];
        static::$extensionsMethods = [];
    }

    /**
     * Resolve the method called to extensions
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function callExtensionMethod(string $method, array $parameters = []) {
        if (!isset(static::$extensionsMethods[$method])) {
            throw new RuntimeException(sprintf('The %s method does not exist', $method));
        }

        return static::$extensions[static::$extensionsMethods[$method]]($parameters);
    }
}