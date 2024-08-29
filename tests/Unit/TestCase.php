<?php

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Container\Container;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        Container::basePath(__DIR__.'/../Support');
        Container::packageManifestPath('/tmp/packages.php');
        Container::containerMixinManifestPath('/tmp/ContainerMixin.php');
    }
}
