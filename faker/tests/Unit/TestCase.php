<?php

namespace Xefi\Faker\Tests\Unit;

use Xefi\Faker\Container;
use Xefi\Faker\Strategies\UniqueStrategy;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        Container::basePath(__DIR__.'/../Support');
        Container::manifestPath('/tmp/packages.php');
    }

    protected function tearDown(): void
    {
        $container = new Container();
        $container->forgetExtensions();
        $container->forgetBootstrappers();

        $container::basePath('./');
        $container::manifestPath('packages.php');

        (new UniqueStrategy)->forgetSeeds();
    }
}