<?php

namespace Xefi\Faker\Container\Traits;

use Random\Randomizer;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Exceptions\NoExtensionLocaleFound;
use Xefi\Faker\Extensions\Extension;

trait HasExtensions
{
    /**
     * The faker extensions.
     *
     * @var array
     */
    protected static array $extensions = [];

    /**
     * The extensions methods linked to extension name.
     *
     * @var array
     */
    protected static array $extensionsMethods = [];

    /**
     * Resolve an array of extensions through the container.
     *
     * @param array $extensions
     *
     * @return $this
     */
    public function resolveExtensions(array $extensions): self
    {
        foreach ($extensions as $extension) {
            $this->resolve($extension);
        }

        return $this;
    }

    /**
     * Add an extension, resolving through the application.
     *
     * @param Extension|string $extension
     *
     * @return Container
     */
    protected function resolve(\Xefi\Faker\Extensions\Extension|string $extension): Container
    {
        $instance = $extension instanceof Extension ? $extension : new $extension(new Randomizer());

        // If the extension supports locale variations
        if (method_exists($instance, 'getLocale')) {
            return $this->addLocaleExtension($instance);
        }

        return $this->addExtension($instance);
    }

    /**
     * Add an extension to the container.
     *
     * @param \Xefi\Faker\Extensions\Extension $extension
     *
     * @return \Xefi\Faker\Extensions\Extension
     */
    protected function addExtension(Extension $extension): Container
    {
        if (isset(static::$extensions[$extension->getName()])) {
            trigger_error(sprintf('[XEFI FAKER] The \'%s\' extension is already registered', $extension->getName()), E_USER_WARNING);
        }

        static::$extensions[$extension->getName()] = $extension;

        // Here we register all the extensions methods in order to have a quick access after
        foreach (get_class_methods($extension) as $method) {
            // If the method is common
            if (in_array($method, ['getName', '__construct'])) {
                continue;
            }

            if (isset(static::$extensionsMethods[$method])) {
                trigger_error(sprintf('[XEFI FAKER] The \'%s\' method from \'%s\' is already registered', $method, $extension->getName()), E_USER_WARNING);
            }

            static::$extensionsMethods[$method] = $extension->getName();
        }

        return $this;
    }

    /**
     * Add an extension to the container.
     *
     * @param \Xefi\Faker\Extensions\Extension $extension
     *
     * @return \Xefi\Faker\Extensions\Extension
     */
    protected function addLocaleExtension(Extension $extension): Container
    {
        if (!isset(static::$extensions[$extension->getName()])) {
            static::$extensions[$extension->getName()] = [
                'locales' => [],
            ];
        }

        if (isset(static::$extensions[$extension->getName()]['locales'][$extension->getLocale()])) {
            trigger_error(sprintf('[XEFI FAKER] The \'%s\' extension in locale \'%s\' is already registered', $extension->getName(), $extension->getLocale()), E_USER_WARNING);
        }

        static::$extensions[$extension->getName()]['locales'][$extension->getLocale()] = $extension;

        // Here we register all the extensions methods in order to have a quick access after
        foreach (get_class_methods($extension) as $method) {
            // If the method is common
            if (in_array($method, ['getName', '__construct'])) {
                continue;
            }

            // The method for another locale has been set
            if (isset(static::$extensionsMethods[$method])) {
                continue;
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
     * Get the container extensions methods.
     *
     * @return array
     */
    public function getExtensionMethods(): array
    {
        return static::$extensionsMethods;
    }

    /**
     * See if the extensions has already been set.
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
     * Resolve the method called to extensions.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function callExtensionMethod(string $method, array $parameters = [])
    {
        if (!isset(static::$extensionsMethods[$method])) {
            throw new \BadMethodCallException(sprintf('The %s method does not exist', $method));
        }

        $extension = static::$extensions[static::$extensionsMethods[$method]];

        // We assume we here have multiple extensions declined by locale, we will try
        // to get the extension with the current locale, defaulting to first element
        if (is_array($extension) && isset($extension['locales'])) {
            if (!isset($extension['locales'][$this->getLocale()]) && !isset($extension['locales'][null])) {
                throw new NoExtensionLocaleFound(sprintf('Locale \'%s\' and \'null\' for method \'%s\' was not found', $this->getLocale(), $method));
            }
            $extension = $extension['locales'][$this->getLocale()] ?? $extension['locales'][null];
        }

        return $extension->$method(...$parameters);
    }
}
