<?php declare(strict_types=1);


use Xefi\Faker\Tests\Unit\TestCase;

final class ProviderRepositoryTest extends TestCase
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
        $testServiceProvider = $this->createMock(\Xefi\Faker\Tests\Support\TestServiceProvider::class);

        $testServiceProvider->expects($this->once())
            ->method('boot');

        $repo = new \Xefi\Faker\Providers\ProviderRepository();
        $repo->load([
            $testServiceProvider
        ]);
    }
}
