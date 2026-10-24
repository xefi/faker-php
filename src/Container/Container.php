<?php

namespace Xefi\Faker\Container;

use Closure;
use Composer\InstalledVersions;
use Xefi\Faker\Container\Traits\HasExtensions;
use Xefi\Faker\Container\Traits\HasLocale;
use Xefi\Faker\Container\Traits\HasModifiers;
use Xefi\Faker\Container\Traits\HasStrategies;
use Xefi\Faker\Exceptions\MaximumTriesReached;
use Xefi\Faker\Manifests\ContainerMixinManifest;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Providers\ProviderRepository;

class Container
{
    use HasStrategies;
    use HasExtensions;
    use HasModifiers;
    use HasLocale;

    /**
     * The container application bootstrappers.
     *
     * @var array
     */
    protected static array $bootstrappers = [];

    /**
     * The base path of the application, defaulting to the Composer root package.
     *
     * @var ?string
     */
    protected static ?string $basePath = null;

    /**
     * The manifest path where the providers will be stored, defaulting to the base path.
     *
     * @var ?string
     */
    protected static ?string $packageManifestPath = null;

    /**
     * The container mixin manifest path, defaulting to the base path.
     *
     * @var ?string
     */
    protected static ?string $containerMixinManifestPath = null;

    /**
     * Create the container instance.
     *
     * @return void
     */
    public function __construct(bool $shouldBuildContainerMixin = true)
    {
        if (!$this->areExtensionsInitialized()) {
            $this->registerConfiguredProviders();

            $this->bootstrap();

            // The mixin describes the registered extensions, so it only needs checking when they are
            // initialized: checking it on every call costs several filesystem stats per generated value.
            if ($shouldBuildContainerMixin) {
                $this->buildContainerMixinManifest();
            }
        }
    }

    /**
     * Set the package manifest path.
     *
     * @param string $manifestPath
     *
     * @return void
     */
    public static function packageManifestPath(string $manifestPath)
    {
        static::$packageManifestPath = $manifestPath;
    }

    /**
     * Set the container mixin manifest path.
     *
     * @param string $containerMixinManifestPath
     *
     * @return void
     */
    public static function containerMixinManifestPath(string $containerMixinManifestPath)
    {
        static::$containerMixinManifestPath = $containerMixinManifestPath;
    }

    /**
     * Set the base path.
     *
     * @param string $basePath
     *
     * @return void
     */
    public static function basePath(string $basePath)
    {
        static::$basePath = $basePath;
    }

    /**
     * Get the base path, defaulting to the Composer root package install path.
     *
     * @return string
     */
    public static function getBasePath(): string
    {
        return static::$basePath ?? realpath(InstalledVersions::getRootPackage()['install_path']);
    }

    /**
     * Get the package manifest path, defaulting to the base path.
     *
     * @return string
     */
    public static function getPackageManifestPath(): string
    {
        return static::$packageManifestPath ?? static::getBasePath().'/packages.php';
    }

    /**
     * Get the container mixin manifest path, defaulting to the base path.
     *
     * @return string
     */
    public static function getContainerMixinManifestPath(): string
    {
        return static::$containerMixinManifestPath ?? static::getBasePath().'/faker_mixin.php';
    }

    /**
     * Build container mixin manifest.
     */
    protected function buildContainerMixinManifest()
    {
        $containerMixinManifest = new ContainerMixinManifest(static::getBasePath(), static::getContainerMixinManifestPath());
        $containerMixinManifest->buildIfShould($this->getExtensionMethods(), $this->getExtensions());
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    protected function registerConfiguredProviders()
    {
        $packageManifest = new PackageManifest(static::getBasePath(), static::getPackageManifestPath());

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
     *
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
     * Reset the bootstrappers.
     *
     * @return void
     */
    public function forgetBootstrappers(): void
    {
        static::$bootstrappers = [];
    }

    /**
     * @param $method
     *
     * @return mixed
     */
    public function run($method, $parameters)
    {
        $tries = 0;
        do {
            $generatedValue = $this->callExtensionMethod($method, $parameters);

            // Apply modifiers
            $generatedValue = $this->applyModifiers($generatedValue);

            if (++$tries > 20000) {
                throw new MaximumTriesReached(
                    sprintf(
                        'Maximum of %d tries reached while generating a value for "%s". '
                        .'This usually means the active constraints (e.g. unique, valid, or custom strategies) '
                        .'have exhausted the available pool of values. '
                        .'Consider relaxing your constraints, broadening the input range, '
                        .'or removing the unique requirement if the data set is too small.',
                        20000,
                        $method
                    )
                );
            }
        } while (!$this->passStrategies($generatedValue));

        // Here we assume the container has done his job and reset the strategies
        // in case the user wants to run the method again on another extension
        $this->forgetStrategies();

        return $generatedValue;
    }

    /**
     * Dynamically call the extension.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->run($method, $parameters);
    }
}
