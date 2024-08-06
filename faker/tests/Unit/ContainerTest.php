<?php declare(strict_types=1);

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Container;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Support\Extensions\NumberTestExtension;
use Xefi\Faker\Tests\Support\Extensions\StringTestExtension;

final class ContainerTest extends TestCase
{
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
                'number-test-extension' => new NumberTestExtension,
                'string-test-extension' => new StringTestExtension
            ],
            $container->getExtensions()
        );

        unlink('/tmp/packages.php');
    }
}
