<?php

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Container\Container;
use Xefi\Faker\Strategies\UniqueStrategy;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        Container::basePath(__DIR__.'/../Support');
        Container::packageManifestPath('/tmp/packages.php');
        Container::containerMixinManifestPath('/tmp/ContainerMixin.php');
    }

    protected function tearDown(): void
    {
        $container = new Container();
        $container->forgetExtensions();
        $container->forgetBootstrappers();

        $container::basePath('./');
        $container::packageManifestPath('packages.php');
        $container::containerMixinManifestPath('./vendor/xefi/faker/src/Container/ContainerMixin.php');

        (new UniqueStrategy)->forgetSeeds();
    }
}