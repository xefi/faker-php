<?php declare(strict_types=1);


use Xefi\Faker\Container;
use Xefi\Faker\Manifests\PackageManifest;
use Xefi\Faker\Tests\Support\Extensions\TestExtension;

final class ProviderRepositoryTest extends \Xefi\Faker\Tests\Unit\TestCase
{
    public function testCreateProvider()
    {
        $repo = new \Xefi\Faker\Providers\ProviderRepository();

        $this->assertEquals(
            $repo->createProvider(\Xefi\Faker\Tests\Support\TestServiceProvider::class),
            new \Xefi\Faker\Tests\Support\TestServiceProvider()
        );
    }

    public function testLoad()
    {
        $repo = new \Xefi\Faker\Providers\ProviderRepository();
        $repo->load([\Xefi\Faker\Tests\Support\TestServiceProvider::class]);

        $reflectionClass = new \ReflectionClass(Container::class);
        $property = $reflectionClass->getProperty('extensions');
        $property->setAccessible(true);

        $this->assertEquals(
            $property->getValue($repo),
            ['test-extension' => new TestExtension]
        );

    }
}
