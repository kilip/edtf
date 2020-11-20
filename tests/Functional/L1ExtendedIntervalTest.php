<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;

use EDTF\EDTF;
use EDTF\Interval;
use PHPUnit\Framework\TestCase;

/**
 * Class L1ExtendedIntervalTest
 *
 * @covers \EDTF\Parser
 * @covers \EDTF\Interval
 * @package EDTF\Tests\Unit
 */
class L1ExtendedIntervalTest extends TestCase
{
    use FactoryTrait;

    public function testOpenEndTimeWithDayPrecision()
    {
        $interval = $this->createInterval("1985-04-12/..");

        $this->assertTrue($interval->getStart()->isNormalInterval());
        $this->assertSame(1985, $interval->getStart()->getYear());
        $this->assertSame(4, $interval->getStart()->getMonth());
        $this->assertSame(12, $interval->getStart()->getDay());

        $this->assertTrue($interval->getEnd()->isOpenInterval());
    }

    public function testOpenEndTimeWithMonthPrecision()
    {
        $interval = $this->createInterval("1985-04/..");

        $this->assertTrue($interval->getStart()->isNormalInterval());
        $this->assertSame(1985, $interval->getStart()->getYear());
        $this->assertSame(4, $interval->getStart()->getMonth());
        $this->assertNull($interval->getStart()->getDay());

        $this->assertTrue($interval->getEnd()->isOpenInterval());
    }

    public function testOpenEndTimeWithYearPrecision()
    {
        $interval = $this->createInterval("1985/..");

        $this->assertTrue($interval->getStart()->isNormalInterval());
        $this->assertSame(1985, $interval->getStart()->getYear());
        $this->assertNull($interval->getStart()->getMonth());
        $this->assertNull($interval->getStart()->getDay());

        $this->assertTrue($interval->getEnd()->isOpenInterval());
    }

    public function testOpenStartTimeDayPrecision()
    {
        $interval = $this->createInterval("../1985-04-12");

        // start assertion
        $this->assertTrue($interval->getStart()->isOpenInterval());

        // end assertion
        $this->assertTrue($interval->getEnd()->isNormalInterval());
        $this->assertSame(1985, $interval->getEnd()->getYear());
        $this->assertSame(4, $interval->getEnd()->getMonth());
        $this->assertSame(12, $interval->getEnd()->getDay());
    }

    public function testOpenStartTimeMonthPrecision()
    {
        $interval = $this->createInterval("../1985-04");

        // start assertion
        $this->assertTrue($interval->getStart()->isOpenInterval());

        // end assertion
        $this->assertTrue($interval->getEnd()->isNormalInterval());
        $this->assertSame(1985, $interval->getEnd()->getYear());
        $this->assertSame(4, $interval->getEnd()->getMonth());
        $this->assertNull($interval->getEnd()->getDay());
    }

    public function testOpenStartTimeYearPrecision()
    {
        $interval = $this->createInterval("../1985");

        // start assertion
        $this->assertTrue($interval->getStart()->isOpenInterval());

        // end assertion
        $this->assertTrue($interval->getEnd()->isNormalInterval());
        $this->assertSame(1985, $interval->getEnd()->getYear());
        $this->assertNull($interval->getEnd()->getMonth());
        $this->assertNull($interval->getEnd()->getDay());
    }

    public function testWithUnknownStartYearPrecision()
    {
        $interval = $this->createInterval("/2006");

        $this->assertTrue($interval->getStart()->isUnknownInterval());
        $this->assertNull($interval->getStart()->getYear());


        $this->assertSame(2006, $interval->getEnd()->getYear());
        $this->assertTrue($interval->getEnd()->isNormalInterval());
    }

    public function testWithUnknownEndDayPrecision()
    {
        $interval = $this->createInterval("2004-06-01/");

        $this->assertTrue($interval->getStart()->isNormalInterval());
        $this->assertSame(2004, $interval->getStart()->getYear());
        $this->assertSame(6, $interval->getStart()->getMonth());
        $this->assertSame(1, $interval->getStart()->getDay());

        $this->assertTrue($interval->getEnd()->isUnknownInterval());
    }
}
