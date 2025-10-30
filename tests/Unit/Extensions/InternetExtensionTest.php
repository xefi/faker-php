<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use ReflectionClass;
use Xefi\Faker\Container\Container;

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

    public function testEmail(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->unique()->email();
        }

        foreach ($results as $result) {
            // Email regex according to RFC 5322 Official Standard (reference : https://emailregex.com/)
            $this->assertMatchesRegularExpression('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $result);
        }
    }

    public function testLatitude(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^-?(?:[0-8]?\d(?:\.\d{1,8})?|90(?:\.0+)?$)/', $this->faker->unique()->latitude());
        }
    }

    public function testLongitude(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^-?(?:1[0-7]\d(?:\.\d{1,8})?|180(?:\.0+)?|[0-9]?\d(?:\.\d{1,8})?)$/', $this->faker->unique()->longitude());
        }
    }

    public function testGeoLocation(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(-?(?:[0-8]?\d(?:\.\d+)?|90(?:\.0+)?)),\s*(-?(?:1[0-7]\d(?:\.\d+)?|180(?:\.0+)?|[0-9]?\d(?:\.\d+)?))$/', $this->faker->unique()->geoLocation());
        }
    }
}
