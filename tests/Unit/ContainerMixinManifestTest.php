<?php

declare(strict_types=1);

namespace Xefi\Faker\Tests\Unit;

final class ContainerMixinManifestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $container = new \Xefi\Faker\Container\Container();
        $container->forgetExtensions();
        $container->resolveExtensions([
            \Xefi\Faker\Tests\Support\Extensions\MixinTestExtension::class,
        ]);
    }

    public function testContainerMixinBuild()
    {
        @unlink('/tmp/ContainerMixin.php');
        $container = new \Xefi\Faker\Container\Container(shouldBuildContainerMixin: false);
        $manifest = new \Xefi\Faker\Manifests\ContainerMixinManifest(__DIR__.'/../Support', '/tmp/ContainerMixin.php');
        $manifest->build($container->getExtensionMethods(), $container->getExtensions());

        $this->assertFileExists('/tmp/ContainerMixin.php');

        $containerMixinContent = file_get_contents('/tmp/ContainerMixin.php');

        $this->assertStringContainsString(
            '@method mixed withoutParameters()',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method mixed withNoTypeParameters(mixed $one, mixed $two)',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method mixed withTypedParameters(int $one, string $two)',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method void withVoidReturnType()',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method string withStringReturnType()',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method string withNullableParameter(?string $one = \'default value\')',
            $containerMixinContent
        );

        $this->assertStringContainsString(
            '@method string|int withUnionType(string|int $param)',
            $containerMixinContent
        );

        $this->assertStringNotContainsString(
            '@method string|int withUnionType(string&int $param)',
            $containerMixinContent
        );

        unlink('/tmp/ContainerMixin.php');
    }

    public function testContainerMixinNamespace()
    {
        @unlink('/tmp/ContainerMixin.php');
        $container = new \Xefi\Faker\Container\Container(shouldBuildContainerMixin: false);
        $manifest = new \Xefi\Faker\Manifests\ContainerMixinManifest(__DIR__.'/../Support', '/tmp/ContainerMixin.php');
        $manifest->build($container->getExtensionMethods(), $container->getExtensions());

        $this->assertFileExists('/tmp/ContainerMixin.php');

        $containerMixinContent = file_get_contents('/tmp/ContainerMixin.php');

        $this->assertStringContainsString(
            'namespace Xefi\\Faker\\Container;',
            $containerMixinContent
        );

        unlink('/tmp/ContainerMixin.php');
    }

    public function testShouldRecompile()
    {
        @unlink('/tmp/ContainerMixin.php');
        $container = new \Xefi\Faker\Container\Container(shouldBuildContainerMixin: false);
        $manifest = new \Xefi\Faker\Manifests\ContainerMixinManifest(__DIR__.'/../Support', '/tmp/ContainerMixin.php');
        $manifest->build($container->getExtensionMethods(), $container->getExtensions());
        touch(__DIR__.'/../Support/vendor/composer/installed.json', time() - 1);

        $this->assertFalse($manifest->shouldRecompile());

        // Test on current time
        touch(__DIR__.'/../Support/vendor/composer/installed.json');
        $this->assertTrue($manifest->shouldRecompile());

        // Test on future
        touch(__DIR__.'/../Support/vendor/composer/installed.json', time() + 1);
        $this->assertTrue($manifest->shouldRecompile());

        unlink('/tmp/ContainerMixin.php');
    }

    public function testNoExtension()
    {
        @unlink('/tmp/ContainerMixin.php');
        $container = new \Xefi\Faker\Container\Container(shouldBuildContainerMixin: false);
        $container->forgetExtensions();

        $manifest = new \Xefi\Faker\Manifests\ContainerMixinManifest(__DIR__.'/../Support', '/tmp/ContainerMixin.php');
        $manifest->build($container->getExtensionMethods(), $container->getExtensions());

        $this->assertFileExists('/tmp/ContainerMixin.php');
    }
}
