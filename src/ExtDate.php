<?php

declare(strict_types=1);

namespace EDTF;


use EDTF\Contracts\ExtDateInterface;

class ExtDate implements ExtDateInterface
{
    protected ?int $year;
    protected ?int $month;
    protected ?int $day;
    protected Qualification $qualification;
    protected Unspecified $unspecified;
    protected int $intervalType;

    public function __construct(
        ?int $year,
        ?int $month,
        ?int $day,
        ?Qualification $qualification = null,
        ?Unspecified  $unspecified = null,
        int $intervalType = 0
    )
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;

        $this->qualification = is_null($qualification) ? new Qualification():$qualification;
        $this->unspecified = is_null($unspecified) ? new Unspecified():$unspecified;
        $this->intervalType = $intervalType;
    }

    public function uncertain(?string $part = null): bool
    {
        /**
         * @psalm-suppress PossiblyNullReference
         */
        return $this->qualification->uncertain($part);
    }

    public function approximate(?string $part = null): bool
    {
        /**
         * @psalm-suppress PossiblyNullReference
         */
        return $this->qualification->approximate($part);
    }

    public function uncertainAndApproximate(?string $part = null): bool
    {
        /**
         * @psalm-suppress PossiblyNullReference
         */
        return $this->qualification->uncertainAndApproximate($part);
    }

    public function isNormalInterval(): bool
    {
        return Interval::NORMAL === $this->intervalType;
    }

    public function isOpenInterval(): bool
    {
        return Interval::OPEN === $this->intervalType;
    }

    public function isUnknownInterval(): bool
    {
        return Interval::UNKNOWN === $this->intervalType;
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