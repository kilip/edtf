<?php

namespace EDTF\Tests\Unit;

use EDTF\Unspecified;
use PHPUnit\Framework\TestCase;

/**
 * Class UnspecifiedTest
 *
 * @covers \EDTF\Unspecified
 * @package EDTF\Tests\Unit
 */
class UnspecifiedTest extends TestCase
{
    public function testDefaultValue()
    {
        $u = new Unspecified();
        $this->assertTrue($u->specified('year'));
        $this->assertTrue($u->specified('month'));
        $this->assertTrue($u->specified('day'));
    }

    public function testSpecified()
    {
        $u = new Unspecified(Unspecified::SPECIFIED);
        $this->assertTrue($u->specified('year'));
    }

    public function testUnspecified()
    {
        $u = new Unspecified(Unspecified::UNSPECIFIED);
        $this->assertTrue($u->unspecified('year'));
    }
}
