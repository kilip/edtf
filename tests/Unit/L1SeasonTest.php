<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;

use EDTF\Season;
use PHPUnit\Framework\TestCase;

/**
 * Class L1SeasonTest
 *
 * @covers \EDTF\Parser
 * @covers \EDTF\Season
 * @package EDTF\Tests\Unit
 */
class L1SeasonTest extends TestCase
{
    use FactoryTrait;

    public function testSeason()
    {
        $dt = $this->createSeason("2001-21");

        $this->assertSame(2001, $dt->getYear());
        $this->assertSame(21, $dt->getSeason());
    }
}
