<?php

declare(strict_types=1);

namespace EDTF;

class Season
{
    private int $year;

    private int $season;

    public function __construct(int $year, int $season)
    {
        $this->year = $year;
        $this->season = $season;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getSeason(): int
    {
        return $this->season;
    }
}