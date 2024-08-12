<?php

namespace Xefi\Faker\Container;

use Closure;
use Xefi\Faker\Container\Traits\HasExtensions;
use Xefi\Faker\Container\Traits\HasLocale;
use Xefi\Faker\Container\Traits\HasStrategies;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Providers\ProviderRepository;

class Container
{
    use HasStrategies, HasExtensions, HasLocale;

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
        if (!$this->areExtensionsInitialized()) {
            $this->registerConfiguredProviders();

            $this->bootstrap();
        }
    }

    /**
     * Set the manifest path
     *
     * @param string $manifestPath
     * @return void
     */
    public static function manifestPath(string $manifestPath) {
        static::$manifestPath = $manifestPath;
    }

    /**
     * Set the base path
     *
     * @param string $basePath
     * @return void
     */
    public static function basePath(string $basePath) {
        static::$basePath = $basePath;
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    protected function registerConfiguredProviders()
    {
        $packageManifest = new PackageManifest(static::$basePath, static::$manifestPath);

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
     * Reset the bootstrappers
     *
     * @return void
     */
    public function forgetBootstrappers(): void
    {
        static::$bootstrappers = [];
    }

    /**
     * @param $method
     * @return mixed
     */
    public function run($method, $parameters)
    {
        $tries = 0;
        do {
            $generatedValue = $this->callExtensionMethod($method, $parameters);

            if (++$tries > 20000) {
                throw new MaximumTriesReached(sprintf('Maximum tries of %d reached without finding a value', 20000));
            }
        } while(!$this->passStrategies($generatedValue));


        // Here we assume the container has done his job and reset the strategies
        // in case the user wants to run the method again on another extension
        $this->forgetStrategies();

        return $generatedValue;
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
        return $this->run($method, $parameters);
    }
}

// @TODO: generate mixin ?
