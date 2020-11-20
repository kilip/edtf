<?php

declare(strict_types=1);

namespace EDTF;

class Uncertainity
{
    /**
     * Determines if a date part qualification is uncertain,
     * specified by using "?" sign
     */
    const UNCERTAIN = 1;

    /**
     * Determines if a date part qualification is approximate
     * specified by using "~" sign
     */
    const APPROXIMATE = 2;

    /**
     * Determines if a date part qualification is uncertain and approximate
     * specified by using "%" flag
     */
    const UNCERTAIN_AND_APPROXIMATE = 3;

    /**
     * Determines if a date part is unspecified
     * specified by using "X" flag in date part value
     *
     * Example: 198X-XX-XX
     */
    const UNSPECIFIED = 4;

    private ?int $year;
    private ?int $month;
    private ?int $day;

    public function __construct(?int $year, ?int $month, ?int $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }
}