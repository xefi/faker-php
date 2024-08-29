<?php

declare(strict_types=1);

use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Unit\TestCase;

final class PackageManifestTest extends TestCase
{
    public function testAssetLoading()
    {
        @unlink('/tmp/packages.php');
        $manifest = new PackageManifest(__DIR__.'/../Support', '/tmp/packages.php');
        $this->assertEquals(
            ['autoload-needed' => [\Xefi\Faker\Tests\Support\TestServiceProvider::class]],
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
}
