<?php

declare(strict_types=1);

namespace EDTF;


use EDTF\Contracts\DateTimeInterface;

class Season implements DateTimeInterface
{
    private int $year;

    private int $season;

    public function __construct(int $year, int $season)
    {
        $this->year = $year;
        $this->season = $season;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }
}