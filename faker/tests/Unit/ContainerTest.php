<?php declare(strict_types=1);

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Container;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Support\Extensions\TestExtension;

final class ContainerTest extends TestCase
{
    protected function setUp(): void
    {
        Container::basePath(__DIR__.'/../Support');
        Container::manifestPath('/tmp/packages.php');
    }

    public function testManifestGenerated(): void
    {
        new Container();

        $this->assertFileExists('/tmp/packages.php');

        unlink('/tmp/packages.php');
    }

    public function testExtensionsCorrectlyRegistered(): void
    {
        $container = new Container();

        $this->assertEquals(
            ['test-extension' => new TestExtension],
            $container->getExtensions()
        );

        unlink('/tmp/packages.php');
    }
}
