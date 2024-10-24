<?php

namespace Extensions;

use ReflectionClass;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Tests\Unit\Extensions\TestCase;

final class InternetExtensionTest extends TestCase
{
    protected array $tld = [];

    protected function setUp(): void
    {
        parent::setUp();

        $internetExtension = new \Xefi\Faker\Extensions\InternetExtension(new \Random\Randomizer());
        $this->tld = (new ReflectionClass($internetExtension))->getProperty('tld')->getValue($internetExtension);
    }

    public function testSdl(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->sdl();
        }

        foreach ($results as $result) {
            $this->assertTrue(ctype_alnum($result));
        }
    }

    public function testTld(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < count($this->tld); $i++) {
            $results[] = $faker->unique()->tld();
        }

        $this->assertEqualsCanonicalizing($results, $this->tld);
    }

    public function testDomain(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->domain();
        }

        foreach ($results as $result) {
            $this->assertMatchesRegularExpression('/^([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,}$/', $result);
        }
    }

    public function testIpv4(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->ipv4();
        }

        foreach ($results as $result) {
            $this->assertNotFalse(filter_var($result, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4));
        }
    }

    public function testIpv6(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->ipv6();
        }

        foreach ($results as $result) {
            $this->assertNotFalse(filter_var($result, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6));
        }
    }

    public function testMacAddress(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->macAddress();
        }

        foreach ($results as $result) {
            $this->assertNotFalse(filter_var($result, FILTER_VALIDATE_MAC));
        }
    }
}
