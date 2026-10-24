<?php

declare(strict_types=1);

namespace Xefi\Faker\Tests\Unit;

use Composer\InstalledVersions;
use Random\Randomizer;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Tests\Support\Concerns\CreatesTemporaryProjects;
use Xefi\Faker\Tests\Support\Extensions\NumberTestExtension;
use Xefi\Faker\Tests\Support\Extensions\StringTestExtension;

final class ContainerTest extends TestCase
{
    use CreatesTemporaryProjects;

    protected function tearDown(): void
    {
        $this->deleteTemporaryProjects();

        parent::tearDown();
    }

    public function testManifestGenerated(): void
    {
        @unlink('/tmp/packages.php');

        new Container();

        $this->assertFileExists('/tmp/packages.php');

        unlink('/tmp/packages.php');
    }

    public function testExtensionsCorrectlyRegistered(): void
    {
        @unlink('/tmp/packages.php');

        $container = new Container();

        $this->assertEquals(
            [
                'number-test-extension' => new NumberTestExtension(new Randomizer()),
                'string-test-extension' => new StringTestExtension(new Randomizer()),
            ],
            $container->getExtensions()
        );

        unlink('/tmp/packages.php');
    }

    public function testPathsDefaultToTheComposerRootPackage(): void
    {
        $this->forgetConfiguredPaths();

        $rootPath = realpath(InstalledVersions::getRootPackage()['install_path']);

        $this->assertSame($rootPath, Container::getBasePath());
        $this->assertSame($rootPath.'/packages.php', Container::getPackageManifestPath());
        $this->assertSame($rootPath.'/faker_mixin.php', Container::getContainerMixinManifestPath());
    }

    public function testManifestsAreWrittenUnderTheBasePathRatherThanTheWorkingDirectory(): void
    {
        $container = new Container(shouldBuildContainerMixin: false);
        $container->forgetExtensions();
        $container->forgetBootstrappers();

        $projectPath = $this->createTemporaryProject();
        $workingPath = $this->createTemporaryProject();

        $this->forgetConfiguredPaths();
        Container::basePath($projectPath);

        $previousWorkingPath = getcwd();
        chdir($workingPath);

        try {
            new Container();
        } finally {
            chdir($previousWorkingPath);
        }

        $this->assertFileExists($projectPath.'/packages.php');
        $this->assertFileExists($projectPath.'/faker_mixin.php');
        $this->assertFileDoesNotExist($workingPath.'/packages.php');
        $this->assertFileDoesNotExist($workingPath.'/faker_mixin.php');
    }

    /**
     * Reset the configured paths so the container falls back to its defaults.
     *
     * @return void
     */
    private function forgetConfiguredPaths(): void
    {
        foreach (['basePath', 'packageManifestPath', 'containerMixinManifestPath'] as $property) {
            (new \ReflectionProperty(Container::class, $property))->setValue(null, null);
        }
    }
}
