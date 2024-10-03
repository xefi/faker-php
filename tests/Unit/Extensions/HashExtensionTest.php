<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\Container\Container;

final class HashExtensionTest extends TestCase
{
    public function testSha1(): void
    {
        $faker = new Container(false);

        $result = $faker->sha1();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{40}$/', $result);
    }

    public function testSha256(): void
    {
        $faker = new Container(false);

        $result = $faker->sha256();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{64}$/', $result);
    }

    public function testSha512(): void
    {
        $faker = new Container(false);

        $result = $faker->sha512();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{128}$/', $result);
    }

    public function testMd5(): void
    {
        $faker = new Container(false);

        $result = $faker->md5();

        $this->assertMatchesRegularExpression('/^[a-fA-F0-9]{32}$/', $result);
    }
}
