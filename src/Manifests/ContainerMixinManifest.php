<?php

namespace Xefi\Faker\Manifests;

use Exception;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Serializer;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Mixed_;

class ContainerMixinManifest
{
    /**
     * The manifest path.
     *
     * @var string
     */
    public string $containerMixinPath;

    /**
     * The vendor path.
     *
     * @var string
     */
    public string $vendorPath;

    /**
     * The base path.
     *
     * @var string
     */
    public string $basePath;

    /**
     * Create a new package manifest instance.
     *
     * @param string      $basePath
     * @param string|null $containerMixinPath
     */
    public function __construct(string $basePath, string $containerMixinPath = null)
    {
        $this->basePath = $basePath;
        $this->vendorPath = $basePath.'/vendor';
        $this->containerMixinPath = $containerMixinPath ?? $basePath.'/vendor/xefi/faker/src/Container/ContainerMixin.php';
    }

    /**
     * Build the manifest only if it should.
     *
     * @param array $extensions
     * @param array $extensionMethods
     *
     * @return void
     */
    public function buildIfShould(array $extensionMethods, array $extensions)
    {
        if ($this->shouldRecompile()) {
            $this->build($extensionMethods, $extensions);
        }
    }

    /**
     * Build the manifest and write it to disk.
     *
     * @param array $extensions
     * @param array $extensionMethods
     *
     * @return void
     */
    public function build(array $extensionMethods, array $extensions)
    {
        foreach ($extensionMethods as $methodName => $extensionName) {
            $extension = $extensions[$extensionName];

            // If the extension is localized
            if (is_array($extension) && isset($extension['locales'])) {
                $extension = $extension['locales']['en-US'];
            }

            $reflectionMethod = new \ReflectionMethod($extension, $methodName);

            $parameters = [];

            foreach ($reflectionMethod->getParameters() as $parameter) {
                $parameters[] = new DocBlock\Tags\MethodParameter(
                    name: $parameter->getName(),
                    type: $parameter->hasType() ? (new TypeResolver())->resolve($parameter->getType()->getName()) : new Mixed_(),
                    defaultValue: $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null
                );
            }

            $tags[] = new Method(
                $methodName,
                returnType: $reflectionMethod->hasReturnType() ? (new TypeResolver())->resolve($reflectionMethod->getReturnType()) : new Mixed_(),
                parameters: $parameters,
            );
        }

        $docBlock = new DocBlock(tags: $tags);

        $serializer = new Serializer();

        $this->write(
            $serializer->getDocComment($docBlock)
        );
    }

    /**
     * Determine if the manifest should be compiled.
     *
     * @return bool
     */
    public function shouldRecompile(): bool
    {
        return !is_file($this->containerMixinPath) ||
            // We check here if the manifest has been generated before changing the installed.json composer file
            filemtime($this->containerMixinPath) <= filemtime($this->vendorPath.'/composer/installed.json');
    }

    /**
     * Write the given manifest docblock to disk.
     *
     * @param string $docComment
     *
     * @return void
     */
    protected function write(string $docComment): void
    {
        if (!is_writable(dirname($this->containerMixinPath))) {
            throw new Exception('The '.dirname($this->containerMixinPath).' directory must be present and writable.');
        }

        file_put_contents(
            $this->containerMixinPath,
            "<?php namespace Xefi\\Faker\\Container{\n{$docComment}\n\tclass ContainerMixin{}"
        );
    }
}
