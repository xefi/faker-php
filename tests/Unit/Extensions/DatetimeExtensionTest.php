<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use DateTime;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Tests\Unit\Extensions\TestCase;

final class DatetimeExtensionTest extends TestCase
{
    public function testTimestampUsingInt(): void
    {
        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $this->faker->timestamp(0, 5000);
        }

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual(0, $result);
            $this->assertLessThanOrEqual(5000, $result);
        }
    }

    public function testTimestampWithWrongIntOrder(): void
    {
        $this->expectException(\ValueError::class);
        $this->faker->timestamp(5000, 0);
    }

    public function testTimestampUsingDatetime(): void
    {
        $results = [];
        $fromDateTime = new \DateTime('1998-06-29');
        $toDateTime = new \DateTime('1998-09-09');

        for ($i = 0; $i < 50; $i++) {
            $results[] = $this->faker->timestamp($fromDateTime, $toDateTime);
        }

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual($fromDateTime->getTimestamp(), $result);
            $this->assertLessThanOrEqual($toDateTime->getTimestamp(), $result);
        }
    }

    public function testTimestampUsingString(): void
    {
        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $this->faker->timestamp('-10 years', '+20 years');
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
        $results = [];

        for ($i = 0; $i < 50; $i++) {
            $results[] = $this->faker->dateTime('-30 years', 'now');
        }

        $fromDateTime = new DateTime('-30 years');
        $toDateTime = new DateTime('now');

        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual($fromDateTime->getTimestamp(), $result->getTimestamp());
            $this->assertLessThanOrEqual($toDateTime->getTimestamp(), $result->getTimestamp());
        }
    }
}
