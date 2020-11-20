<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;


use EDTF\Parser;
use EDTF\Qualification;
use PHPUnit\Framework\TestCase;

/**
 * Class ParserTest
 *
 * @covers \EDTF\Parser
 * @package EDTF\Tests\Unit
 */
class ParserTest extends TestCase
{
    use FactoryTrait;

    public function testShouldParseCompleteDate()
    {
        $parser = $this->parse('2004-01-02');

        $this->assertSame(2004, $parser->getYearNum());
        $this->assertSame(1, $parser->getMonthNum());
        $this->assertSame(2, $parser->getDayNum());
    }

    public function testShouldParseCompleteDateTime()
    {
        $parser = $this->parse('2004-01-02T23:59:59Z');

        $this->assertSame(2004, $parser->getYearNum());
        $this->assertSame(1, $parser->getMonthNum());
        $this->assertSame(2, $parser->getDayNum());
        $this->assertSame(23, $parser->getHour());
        $this->assertSame(59, $parser->getMinute());
        $this->assertSame(59, $parser->getSecond());
    }

    public function testShouldParseUTCTimezone()
    {
        $parser = $this->parse('2004-01-01T10:10:10Z');

        $this->assertSame(2004, $parser->getYearNum());
        $this->assertSame(1, $parser->getMonthNum());
        $this->assertSame(1, $parser->getDayNum());
        $this->assertSame(10, $parser->getHour());
        $this->assertSame(10, $parser->getMinute());
        $this->assertSame(10, $parser->getSecond());
        $this->assertSame("Z", $parser->getTzUtc());
    }

    public function testShouldParseTimezoneValue()
    {
        $parser = $this->parse('2004-01-01T10:10:10+05:30');

        $this->assertSame(2004, $parser->getYearNum());
        $this->assertSame(1, $parser->getMonthNum());
        $this->assertSame(1, $parser->getDayNum());
        $this->assertSame(10, $parser->getHour());
        $this->assertSame(10, $parser->getMinute());
        $this->assertSame(10, $parser->getSecond());
        $this->assertSame(5, $parser->getTzHour());
        $this->assertSame(30, $parser->getTzMinute());
    }

    public function testShouldParseEmptyString()
    {
        $parser = $this->parse('');
        $this->assertNull($parser->getYearNum());
    }

    public function testThrowExceptionOnInvalidDataFormat()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->parse('foo');
    }

    public function testShouldParseLetterPrefixedCalendarYear()
    {
        $parser = $this->parse('Y170000002');
        $this->assertSame(170000002, $parser->getYearNum());

        $parser = $this->parse('Y-170000002');
        $this->assertSame(-170000002, $parser->getYearNum());
    }

    public function testShouldParseSeason()
    {
        $parser = $this->parse('2001-21');
        $this->assertNull($parser->getMonthNum());
        $this->assertSame(21, $parser->getSeason());
    }

    public function testShouldParseQualificationWithinYear()
    {
        $parser = $this->parse('?1984');
        $this->assertSame(1984, $parser->getYearNum());
        $this->assertSame(Qualification::UNCERTAIN, $parser->getYearQualification());

        $parser = $this->parse('1984?');
        $this->assertSame(1984, $parser->getYearNum());
        $this->assertSame(Qualification::UNCERTAIN, $parser->getYearQualification());
    }

    public function testShouldParseQualificationWithinMonth()
    {
        $parser = $this->parse("1984-%02");
        $this->assertSame(2, $parser->getMonthNum());
        $this->assertSame(Qualification::UNCERTAIN_AND_APPROXIMATE, $parser->getMonthQualification());

        $parser = $this->parse("1984-02~");
        $this->assertSame(2, $parser->getMonthNum());
        $this->assertSame(Qualification::APPROXIMATE, $parser->getMonthQualification());
    }

    public function testShouldParseQualificationWithinDay()
    {
        $parser = $this->parse("1984-02-~01");
        $this->assertSame(2, $parser->getMonthNum());
        $this->assertSame(1, $parser->getDayNum());
        $this->assertSame(Qualification::APPROXIMATE, $parser->getDayQualification());

        $parser = $this->parse("1984-02-01%");
        $this->assertSame(2, $parser->getMonthNum());
        $this->assertSame(1, $parser->getDayNum());
        $this->assertSame(Qualification::UNCERTAIN_AND_APPROXIMATE, $parser->getDayQualification());
    }
}