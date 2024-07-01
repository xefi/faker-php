<?php

namespace Xefi\Faker;

use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Manifests\PackageManifest;

class Container
{
    /**
     * The faker extensions
     *
     * @var array
     */
    protected array $extensions;

    /**
     * The container application bootstrappers.
     *
     * @var array
     */
    protected static $bootstrappers = [];

    /**
     * Create the container instance
     *
     * @return void
     */
    public function __construct()
    {
        // @TODO: here this might not work (basePath / manifest path)
        (new PackageManifest(getcwd(), $this->getCachedPackagesPath()))->build();

        $this->bootstrap();
    }

    /**
     * Register a console "starting" bootstrapper.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function starting(Closure $callback): void
    {
        static::$bootstrappers[] = $callback;
    }

    /**
     * Bootstrap the console application.
     *
     * @return void
     */
    protected function bootstrap()
    {
        foreach (static::$bootstrappers as $bootstrapper) {
            $bootstrapper($this);
        }
    }

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
    public function resolve(\Xefi\Faker\Extensions\Extension|string $extension): Extension
    {
        if ($extension instanceof Extension) {
            return $this->add($extension);
        }

        return $this->add(new $extension);
    }

    /**
     * Add an extension to the container.
     *
     * @param  \Xefi\Faker\Extensions\Extension  $extension
     * @return \Xefi\Faker\Extensions\Extension
     */
    public function add(Extension $extension): Container
    {
        $this->extensions[$extension->getName()] = $extension;

        return $extension;
    }

    /**
     * Get the path to the cached packages.php file.
     *
     * @return string
     */
    public function getCachedPackagesPath()
    {
        return 'bootstrap/cache/packages.php';
    }

    /**
     * Dynamically call the extension.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!isset($this->extensions[$method])) {
            throw new \BadMethodCallException(sprintf(
                'Method [%s] does not exist.',
                $method
            ));
        }

        // @TODO: ici a revoir --> maybe call directement les extensions sans passer par l'objet
        return new $this->extensions[$method];
    }
}