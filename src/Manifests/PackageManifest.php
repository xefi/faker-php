<?php

namespace Xefi\Faker\Manifests;

use Exception;

class PackageManifest
{
    /**
     * The manifest path.
     *
     * @var ?string
     */
    public ?string $manifestPath;

    /**
     * The base path.
     *
     * @var string
     */
    public string $basePath;

    /**
     * The vendor path.
     *
     * @var string
     */
    public string $vendorPath;

    /**
     * The loaded manifest array.
     *
     * @var array
     */
    public array $manifest;

    /**
     * Create a new package manifest instance.
     *
     * @param string $manifestPath
     * @param string $basePath
     *
     * @return void
     */
    public function __construct(string $basePath, string $manifestPath)
    {
        $this->basePath = $basePath;
        $this->vendorPath = $basePath.'/vendor';
        $this->manifestPath = $manifestPath;
    }

    /**
     * Get all of the service provider class names for all packages.
     *
     * @return array
     */
    public function providers()
    {
        return $this->config('providers');
    }

    /**
     * Get all of the values for all packages for the given configuration name.
     *
     * @param string $key
     *
     * @return array
     */
    public function config($key)
    {
        return array_filter(
            array_map(
                function ($configuration) use ($key) {
                    return (array) ($configuration[$key] ?? []);
                },
                $this->getManifest()
            )
        );
    }

    /**
     * Get the current package manifest.
     *
     * @return array
     */
    protected function getManifest()
    {
        if (!empty($this->manifest)) {
            return $this->manifest;
        }

        if ($this->shouldRecompile()) {
            $this->build();
        }

        return $this->manifest = is_file($this->manifestPath) ?
            (require $this->manifestPath) : [];
    }

    /**
     * Build the manifest and write it to disk.
     *
     * @return void
     */
    public function build()
    {
        $packages = [];

        if (is_file($path = $this->vendorPath.'/composer/installed.json')) {
            $installed = json_decode(file_get_contents($path), true);

            $packages = $installed['packages'] ?? $installed;
        }

        $packagesToProvide = [];

        foreach ($packages as $package) {
            if (isset($package['extra']['faker'])) {
                $packagesToProvide[$package['name']] = $package['extra']['faker'];
            }
        }

        $this->write(
            $packagesToProvide
        );
    }

    /**
     * Determine if the manifest should be compiled.
     *
     * @return bool
     */
    public function shouldRecompile(): bool
    {
        return !is_file($this->manifestPath) ||
            // We check here if the manifest has been generated before changing the installed.json composer file
            filemtime($this->manifestPath) <= filemtime($this->vendorPath.'/composer/installed.json');
    }

    /**
     * Write the given manifest array to disk.
     *
     * @param array $manifest
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function write(array $manifest): void
    {
        if (!is_writable($dirname = dirname($this->manifestPath))) {
            throw new Exception("The {$dirname} directory must be present and writable.");
        }

        file_put_contents(
            $this->manifestPath,
            '<?php return '.var_export($manifest, true).';'
        );
    }
}
