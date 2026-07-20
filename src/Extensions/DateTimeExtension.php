<?php

namespace Xefi\Faker\Extensions;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

class DateTimeExtension extends Extension
{
    private array $timezones = [
        'America/Chicago',
        'Europe/Moscow',
        'Asia/Kolkata',
        'Pacific/Auckland',
        'Europe/Paris',
        'Africa/Nairobi',
        'America/New-York',
        'Asia/Tokyo',
        'Europe/London',
        'America/Sao_Paulo',
        'Australia/Sydney',
        'Europe/Berlin',
        'Asia/Dubai',
        'America/Los_Angeles',
        'Africa/Cairo',
        'Europe/Amsterdam',
        'Asia/Seoul',
        'Pacific/Fiji',
        'America/Mexico_City',
        'Europe/Athens',
        'Asia/Shanghai',
        'Atlantic/Reykjavik',
        'Africa/Johannesburg',
        'Europe/Stockholm',
        'Asia/Hong_Kong',
        'Pacific/Honolulu',
        'Europe/Warsaw',
        'Australia/Perth',
        'America/Toronto',
    ];

    protected function formatTimestamp(DateTimeInterface|int|string $timestamp): int
    {
        if (is_int($timestamp)) {
            return $timestamp;
        }

        if ($timestamp instanceof DateTimeInterface) {
            return $timestamp->getTimestamp();
        }

        return strtotime($timestamp);
    }

    public function dateTime(DateTimeInterface|int|string $fromTimestamp = '-30 years', DateTimeInterface|int|string $toTimestamp = 'now'): DateTime
    {
        return new DateTime('@'.$this->timestamp($fromTimestamp, $toTimestamp));
    }

    public function dateTimeImmutable(DateTimeInterface|int|string $fromTimestamp = '-30 years', DateTimeInterface|int|string $toTimestamp = 'now'): DateTimeImmutable
    {
        return new DateTimeImmutable('@'.$this->timestamp($fromTimestamp, $toTimestamp));
    }

    public function timestamp(DateTimeInterface|int|string $fromTimestamp = '-30 years', DateTimeInterface|int|string $toTimestamp = 'now'): int
    {
        return $this->randomizer->getInt($this->formatTimestamp($fromTimestamp), $this->formatTimestamp($toTimestamp));
    }

    public function timezone(): string
    {
        return $this->pickArrayRandomElement($this->timezones);
    }
}
