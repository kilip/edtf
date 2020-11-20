<?php

declare(strict_types=1);

namespace EDTF\Tests\Functional;

use EDTF\Tests\Unit\FactoryTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class L1DateTest
 * @covers \EDTF\Parser
 * @covers \EDTF\Interval
 * @covers \EDTF\ExtDateTime
 * @package EDTF\Tests\Unit
 */
class L1QualificationTest extends TestCase
{
    use FactoryTrait;

    public function testApproximateYear()
    {
        $date = $this->createExtDate("1984~");
        $this->assertTrue($date->approximate("year"));
        $this->assertSame(1984, $date->getYear());
    }

    public function testApproximateMonth()
    {
        $date = $this->createExtDate("2004-06~");

        $this->assertTrue($date->approximate('month'));
        $this->assertSame(2004, $date->getYear());
        $this->assertSame(6, $date->getMonth());
    }

    public function testUncertainMonth()
    {
        $dateTime = $this->createExtDate("2004-06?");

        $this->assertTrue($dateTime->uncertain('month'));
        $this->assertSame(2004, $dateTime->getYear());
        $this->assertSame(6, $dateTime->getMonth());
    }

    public function testApproximateAndUncertain()
    {
        $date = $this->createExtDate("2004-06-11%");

        $this->assertTrue($date->uncertainAndApproximate('day'));
        $this->assertSame(2004, $date->getYear());
        $this->assertSame(6, $date->getMonth());
        $this->assertSame(11, $date->getDay());
    }
}