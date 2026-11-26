<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

final class HashExtensionTest extends TestCase
{
    public function testSha1(): void
    {
        $result = $this->faker->sha1();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{40}$/', $result);
    }

    public function testSha1IsSeedable(): void
    {
        $this->assertEquals(
            $this->createFresh()->sha1(),
            $this->createFresh()->sha1(),
        );
    }

    public function testSha256(): void
    {
        $result = $this->faker->sha256();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{64}$/', $result);
    }

    public function testSha256IsSeedable(): void
    {
        $this->assertEquals(
            $this->createFresh()->sha256(),
            $this->createFresh()->sha256(),
        );
    }

    public function testSha512(): void
    {
        $result = $this->faker->sha512();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{128}$/', $result);
    }

    public function testSha512IsSeedable(): void
    {
        $this->assertEquals(
            $this->createFresh()->sha512(),
            $this->createFresh()->sha512(),
        );
    }

    public function testMd5(): void
    {
        $result = $this->faker->md5();

        $this->assertMatchesRegularExpression('/^[a-fA-F0-9]{32}$/', $result);
    }

    public function testMd5IsSeedable(): void
    {
        $this->assertEquals(
            $this->createFresh()->md5(),
            $this->createFresh()->md5(),
        );
    }
}
