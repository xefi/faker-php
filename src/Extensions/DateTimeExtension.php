<?php

namespace Xefi\Faker\Extensions;

use DateTime;

class DateTimeExtension extends Extension
{
    protected array $timezones = [
        "America/Chicago",
        "Europe/Moscow",
        "Asia/Kolkata",
        "Pacific/Auckland",
        "Europe/Paris",
        "Africa/Nairobi",
        "America/New_York",
        "Asia/Tokyo",
        "Europe/London",
        "America/Sao_Paulo",
        "Australia/Sydney",
        "Europe/Berlin",
        "Asia/Dubai",
        "America/Los_Angeles",
        "Africa/Cairo",
        "Europe/Amsterdam",
        "Asia/Seoul",
        "Pacific/Fiji",
        "America/Mexico_City",
        "Europe/Athens",
        "Asia/Shanghai",
        "Atlantic/Reykjavik",
        "Africa/Johannesburg",
        "Europe/Stockholm",
        "Asia/Hong_Kong",
        "Pacific/Honolulu",
        "Europe/Warsaw",
        "Australia/Perth",
        "America/Toronto"
    ];

    protected function formatTimestamp(DateTime|int|string $timestamp): int
    {
        if (is_int($timestamp)) {
            return $timestamp;
        }

        if ($timestamp instanceof DateTime) {
            return $timestamp->getTimestamp();
        }

        return strtotime($timestamp);
    }

    public function dateTime(DateTime|int|string $fromTimestamp = '-30 years', DateTime|int|string $toTimestamp = 'now'): DateTime
    {
        return new DateTime('@'.$this->timestamp($fromTimestamp, $toTimestamp));
    }

    public function timestamp(DateTime|int|string $fromTimestamp = '-30 years', DateTime|int|string $toTimestamp = 'now'): int
    {
        return $this->randomizer->getInt($this->formatTimestamp($fromTimestamp), $this->formatTimestamp($toTimestamp));
    }

    public function timezone() : string{
        return $this->pickArrayRandomElement($this->timezones);
    }
}
