<?php

namespace Xefi\Faker\Extensions;

use DateTime;

class DateTimeExtension extends Extension
{
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

    public function dateTime(DateTime|int|string $fromTimestamp = '-30 tears', DateTime|int|string $toTimestamp = 'now'): DateTime
    {
        return new DateTime('@'.$this->timestamp($fromTimestamp, $toTimestamp));
    }

    public function timestamp(DateTime|int|string $fromTimestamp = '-30 tears', DateTime|int|string $toTimestamp = 'now'): int
    {
        return $this->randomizer->getInt($this->formatTimestamp($fromTimestamp), $this->formatTimestamp($toTimestamp));
    }

    public function dateTimeBetween(DateTime|int|string $from = '-30 years', DateTime|int|string $to = 'now'): DateTime
    {
        $fromTimestamp = $this->formatTimestamp($from);
        $toTimestamp = $this->formatTimestamp($to);

        // @TODO: a tester
        if ($fromTimestamp > $toTimestamp) {
            throw new \InvalidArgumentException('Start date must be anterior to end date.');
        }

        $timestamp = $this->randomizer->getInt($fromTimestamp, $toTimestamp);

        return new \DateTime('@'.$timestamp);
    }
}
