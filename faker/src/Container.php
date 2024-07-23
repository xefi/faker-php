<?php

namespace Xefi\Faker;

use Closure;
use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasExtensions;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Strategies\Traits\HasStrategies;

class Container
{
    use HasStrategies, HasExtensions;

    /**
     * The container application bootstrappers.
     *
     * @var array
     */
    protected static array $bootstrappers = [];

    /**
     * Create the container instance
     *
     * @return void
     */
    public function __construct()
    {
        // @TODO: here this might not work (basePath / manifest path)
        (new PackageManifest(getcwd(), $this->getCachedPackagesPath()))->build();

        // @TODO: here load package manifest packages

        $this->bootstrap();
    }

    /**
     * Register a console "starting" bootstrapper.
     *
     * @param Closure $callback
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
     * Get the path to the cached packages.php file.
     *
     * @TODO: might not be a good idea to put here
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
        // @TODO: ajouter les stratégies
        return new $this->extensions[$method];
    }
}