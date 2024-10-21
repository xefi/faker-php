<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Xefi\Faker\Container\Container;

final class HashExtensionTest extends TestCase
{
    public function testSha1(): void
    {
        $result = $this->faker->sha1();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{40}$/', $result);
    }

    public function testSha256(): void
    {
        $result = $this->faker->sha256();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{64}$/', $result);
    }

    public function testSha512(): void
    {
        $result = $this->faker->sha512();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{128}$/', $result);
    }

    public function testMd5(): void
    {
        $result = $this->faker->md5();

        $this->assertMatchesRegularExpression('/^[a-fA-F0-9]{32}$/', $result);
    }
}
