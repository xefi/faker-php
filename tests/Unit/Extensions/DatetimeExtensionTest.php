<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use DateTime;
use Xefi\Faker\Container\Container;

final class DatetimeExtensionTest extends TestCase
{
    public function testTimestampUsingInt(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->timestamp(0, 5000);
        }

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual(0, $result);
            $this->assertLessThanOrEqual(5000, $result);
        }
    }

    public function testTimestampWithWrongIntOrder(): void
    {
        $faker = new Container(false);

        $this->expectException(\ValueError::class);
        $faker->timestamp(5000, 0);
    }

    public function testTimestampUsingDatetime(): void
    {
        $faker = new Container(false);

        $results = [];
        $fromDateTime = new \DateTime('1998-06-29');
        $toDateTime = new \DateTime('1998-09-09');

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->timestamp($fromDateTime, $toDateTime);
        }

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual($fromDateTime->getTimestamp(), $result);
            $this->assertLessThanOrEqual($toDateTime->getTimestamp(), $result);
        }
    }

    public function testTimestampUsingString(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->timestamp('-10 years', '+20 years');
        }

        $fromDateTime = new DateTime('-10 years');
        $toDateTime = new DateTime('+20 years');

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual($fromDateTime->getTimestamp(), $result);
            $this->assertLessThanOrEqual($toDateTime->getTimestamp(), $result);
        }
    }

    public function testDateTime(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $faker->dateTime('-30 years', 'now');
        }

        $fromDateTime = new DateTime('-30 years');
        $toDateTime = new DateTime('now');

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual($fromDateTime->getTimestamp(), $result->getTimestamp());
            $this->assertLessThanOrEqual($toDateTime->getTimestamp(), $result->getTimestamp());
        }
    }
}
