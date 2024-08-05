<?php declare(strict_types=1);


use Xefi\Faker\Container;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Support\Extensions\TestExtension;

final class PackageManifestTest extends \Xefi\Faker\Tests\Unit\TestCase
{
    public function testAssetLoading()
    {
        @unlink('/tmp/packages.php');
        $manifest = new PackageManifest(__DIR__.'/../Support', '/tmp/packages.php');
        $this->assertEquals(['autoload-needed' => [\Xefi\Faker\Tests\Support\TestServiceProvider::class]], $manifest->providers());
        $this->assertNotContains(['common-package' => []], $manifest->providers());
        unlink('/tmp/packages.php');
    }

    // @TODO: test replace the package.php ? When the dependencies changes
}
