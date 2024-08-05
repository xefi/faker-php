<?php

namespace Xefi\Faker;

use Closure;
use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasExtensions;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Providers\ProviderRepository;
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
     * The base path of the application
     *
     * @var string
     */
    protected static string $basePath = './';

    /**
     * The manifest path where the providers will be stored
     *
     * @var string
     */
    protected static string $manifestPath = 'packages.php';

    /**
     * Create the container instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->registerConfiguredProviders();

        $this->bootstrap();
    }

    /**
     * Set the manifest path
     *
     * @param string $manifestPath
     * @return void
     */
    public static function manifestPath(string $manifestPath) {
        self::$manifestPath = $manifestPath;
    }

    /**
     * Set the base path
     *
     * @param string $basePath
     * @return void
     */
    public static function basePath(string $basePath) {
        self::$basePath = $basePath;
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    protected function registerConfiguredProviders()
    {
        $packageManifest = new PackageManifest(self::$basePath, self::$manifestPath);

        $providers = $packageManifest->providers();

        $collapsedProviders = [];
        foreach ($providers as $values) {
            $collapsedProviders[] = $values;
        }

        (new ProviderRepository())
            ->load(array_merge([], ...$collapsedProviders));
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

        // @TODO: ici passer par les generators et les rendre multiples
        // @TODO: ici a revoir --> maybe call directement les extensions sans passer par l'objet
        // @TODO: ajouter les stratégies
        return new $this->extensions[$method];
    }
}

// @TODO: throw un warning si une extension est register 2 fois / méthode