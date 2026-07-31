<?php

declare(strict_types=1);

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Support\Concerns\CreatesTemporaryProjects;
use Xefi\Faker\Tests\Support\TestServiceProvider;

final class PackageManifestTest extends TestCase
{
    use CreatesTemporaryProjects;

    protected function tearDown(): void
    {
        $this->deleteTemporaryProjects();

        parent::tearDown();
    }

    public function testAssetLoading()
    {
        @unlink('/tmp/packages.php');
        $manifest = new PackageManifest(__DIR__.'/../Support', '/tmp/packages.php');
        $this->assertEquals(
            [
                'autoload-needed' => [\Xefi\Faker\Tests\Support\TestServiceProvider::class],
            ],
            $manifest->providers()
        );
        $this->assertNotContains(['common-package' => []], $manifest->providers());
        unlink('/tmp/packages.php');
    }

    public function testShouldRecompile()
    {
        @unlink('/tmp/packages.php');
        $manifest = new PackageManifest(__DIR__.'/../Support', '/tmp/packages.php');
        $manifest->build();
        touch(__DIR__.'/../Support/vendor/composer/installed.json', time() - 1);

        $this->assertFalse($manifest->shouldRecompile());

        // Test on current time
        touch(__DIR__.'/../Support/vendor/composer/installed.json');
        $this->assertTrue($manifest->shouldRecompile());

        // Test on future
        touch(__DIR__.'/../Support/vendor/composer/installed.json', time() + 1);
        $this->assertTrue($manifest->shouldRecompile());

        unlink('/tmp/packages.php');
    }

    public function testProjectProvidersAreDiscovered()
    {
        $projectPath = $this->createTemporaryProject([
            'name'  => 'xefi/my-project',
            'extra' => [
                'faker' => [
                    'providers' => [TestServiceProvider::class],
                ],
            ],
        ]);

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');

        $this->assertEquals(
            [
                'xefi/my-project' => [TestServiceProvider::class],
            ],
            $manifest->providers()
        );
    }

    public function testProjectProvidersAreMergedWithTheInstalledPackagesOnes()
    {
        $projectPath = $this->createTemporaryProject(
            [
                'name'  => 'xefi/my-project',
                'extra' => [
                    'faker' => [
                        'providers' => ['Xefi\Faker\Tests\Support\ProjectServiceProvider'],
                    ],
                ],
            ],
            [
                [
                    'name'  => 'xefi/faker-number',
                    'extra' => [
                        'faker' => [
                            'providers' => [TestServiceProvider::class],
                        ],
                    ],
                ],
            ]
        );

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');

        $this->assertEquals(
            [
                'xefi/faker-number' => [TestServiceProvider::class],
                'xefi/my-project'   => ['Xefi\Faker\Tests\Support\ProjectServiceProvider'],
            ],
            $manifest->providers()
        );
    }

    public function testProjectProvidersAreKeyedByRootWhenTheProjectHasNoName()
    {
        $projectPath = $this->createTemporaryProject([
            'extra' => [
                'faker' => [
                    'providers' => [TestServiceProvider::class],
                ],
            ],
        ]);

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');

        $this->assertEquals(
            [
                'root' => [TestServiceProvider::class],
            ],
            $manifest->providers()
        );
    }

    public function testProjectWithoutFakerConfigurationIsIgnored()
    {
        $projectPath = $this->createTemporaryProject(
            [
                'name'  => 'xefi/my-project',
                'extra' => [
                    'branch-alias' => ['dev-master' => '2.0.x-dev'],
                ],
            ],
            [
                [
                    'name'  => 'xefi/faker-number',
                    'extra' => [
                        'faker' => [
                            'providers' => [TestServiceProvider::class],
                        ],
                    ],
                ],
            ]
        );

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');

        $this->assertEquals(
            [
                'xefi/faker-number' => [TestServiceProvider::class],
            ],
            $manifest->providers()
        );
    }

    public function testProjectTakesPrecedenceOverAnInstalledPackageOfTheSameName()
    {
        $projectPath = $this->createTemporaryProject(
            [
                'name'  => 'xefi/faker-number',
                'extra' => [
                    'faker' => [
                        'providers' => ['Xefi\Faker\Tests\Support\ProjectServiceProvider'],
                    ],
                ],
            ],
            [
                [
                    'name'  => 'xefi/faker-number',
                    'extra' => [
                        'faker' => [
                            'providers' => [TestServiceProvider::class],
                        ],
                    ],
                ],
            ]
        );

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');

        $this->assertEquals(
            [
                'xefi/faker-number' => ['Xefi\Faker\Tests\Support\ProjectServiceProvider'],
            ],
            $manifest->providers()
        );
    }

    public function testProjectWithoutComposerFileIsIgnored()
    {
        $projectPath = $this->createTemporaryProject(null, [
            [
                'name'  => 'xefi/faker-number',
                'extra' => [
                    'faker' => [
                        'providers' => [TestServiceProvider::class],
                    ],
                ],
            ],
        ]);

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');
        $manifest->build();

        $this->assertEquals(
            [
                'xefi/faker-number' => [
                    'providers' => [TestServiceProvider::class],
                ],
            ],
            require $projectPath.'/packages.php'
        );
    }

    public function testShouldRecompileWhenTheProjectComposerFileChanged()
    {
        $projectPath = $this->createTemporaryProject([
            'name'  => 'xefi/my-project',
            'extra' => [
                'faker' => [
                    'providers' => [TestServiceProvider::class],
                ],
            ],
        ]);

        $manifest = new PackageManifest($projectPath, $projectPath.'/packages.php');
        $manifest->build();
        touch($projectPath.'/vendor/composer/installed.json', time() - 1);
        touch($projectPath.'/composer.json', time() - 1);

        $this->assertFalse($manifest->shouldRecompile());

        // Test on current time
        touch($projectPath.'/composer.json');
        $this->assertTrue($manifest->shouldRecompile());

        // Test on future
        touch($projectPath.'/composer.json', time() + 1);
        $this->assertTrue($manifest->shouldRecompile());
    }
}
