<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;


use EDTF\EDTF;
use EDTF\ExtDate;
use EDTF\ExtDateTime;
use EDTF\Interval;
use EDTF\Parser;
use EDTF\Season;

trait FactoryTrait
{
    public function createSeason(string $data): Season
    {
        $parser = $this->parse($data);
        return new Season($parser->getYearNum(), $parser->getSeason());
    }

    public function createExtDate(string $data): ExtDate
    {
        $parser = $this->parse($data);
        return EDTF::createExtDate($parser);
    }

    public function createExtDateTime(string $data): ExtDateTime
    {
        $parser = $this->parse($data);
        return EDTF::createExtDateTime($parser);
    }

    public function createInterval(string $data): Interval
    {
        return EDTF::createInterval($data);
    }

    public function parse($data): Parser
    {
        $parser = new Parser();
        $parser->parse($data);

        return $parser;
    }
}