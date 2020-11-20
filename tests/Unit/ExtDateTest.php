<?php

namespace EDTF\Tests\Unit;

use EDTF\ExtDate;
use EDTF\Qualification;
use PHPUnit\Framework\TestCase;

/**
 * Class ExtDateTest
 *
 * @covers \EDTF\ExtDate
 * @package EDTF\Tests\Unit
 */
class ExtDateTest extends TestCase
{
    public function testShouldProvideUncertainInfo()
    {
        $q = new Qualification(Qualification::UNCERTAIN);
        $d = new ExtDate(null,null,null, $q);

        $this->assertTrue($d->uncertain());
        $this->assertTrue($d->uncertain('year'));
        $this->assertFalse($d->uncertain('month'));
        $this->assertFalse($d->uncertain('day'));
    }

    public function testShouldProvideApproximateInfo()
    {
        $q = new Qualification(Qualification::UNDEFINED, Qualification::APPROXIMATE);
        $d = new ExtDate(null,null,null, $q);

        $this->assertTrue($d->approximate());
        $this->assertFalse($d->approximate('year'));
        $this->assertTrue($d->approximate('month'));
        $this->assertFalse($d->approximate('day'));
    }

    public function testShouldProvideUncertainAndApproximateInfo()
    {
        $q = new Qualification(Qualification::UNDEFINED, Qualification::UNDEFINED, Qualification::UNCERTAIN_AND_APPROXIMATE);
        $d = new ExtDate(null,null,null, $q);

        $this->assertTrue($d->uncertainAndApproximate());
        $this->assertFalse($d->uncertainAndApproximate('year'));
        $this->assertFalse($d->uncertainAndApproximate('month'));
        $this->assertTrue($d->uncertainAndApproximate('day'));
    }
}
