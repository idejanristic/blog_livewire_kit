<?php

namespace App\ValueObljects;

use Carbon\Carbon;

class DatetimeVO
{
    private Carbon $datetime;

    public function __construct(Carbon $value)
    {
        $this->datetime = $value;
    }

    public function __toString(): string
    {
        return $this->format();
    }

    public function format(string $format = 'Y-m-d H:i:s'): string
    {
        return $this->datetime->format(format: $format);
    }

    public static function now(): self
    {
        return new self(value: Carbon::now());
    }

    public function toCarbon(): Carbon
    {
        return $this->datetime;
    }

    public function date(): string
    {
        return $this->datetime->format(format: 'd M, Y');
    }

    public function datetime(string $format = 'd M, Y H:i'): string
    {
        return $this->datetime->format(format: $format);
    }

    public function diffForHumans(): string
    {
        return $this->datetime->diffForHumans();
    }

    public function isBefore(DatetimeVO $other): bool
    {
        return $this->datetime->lessThan(date: $other->toCarbon());
    }

    public function isAfter(DatetimeVO $other): bool
    {
        return $this->datetime->greaterThan(date: $other->toCarbon());
    }

    public function equals(DatetimeVO $other): bool
    {
        return $this->datetime->eq(date: $other->toCarbon());
    }
}
