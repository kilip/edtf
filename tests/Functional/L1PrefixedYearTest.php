<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Class L1PrefixedYearTest
 *
 * @covers \EDTF\ExtDateTime
 * @covers \EDTF\Parser
 * @package EDTF\Tests\Unit
 */
class L1PrefixedYearTest extends TestCase
{
    use FactoryTrait;

    public function testWithoutDash()
    {
        $dateTime = $this->createExtDate('Y170000002');

        $this->assertSame(170000002, $dateTime->getYear());
    }

    public function testWithDash()
    {
        $dateTime = $this->createExtDate('Y-170000002');

        $this->assertSame(-170000002, $dateTime->getYear());
    }
}