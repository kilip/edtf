<?php

declare(strict_types=1);

namespace EDTF\Tests\Functional;

use EDTF\Tests\Unit\FactoryTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \EDTF\Season
 * @covers \EDTF\Parser
 */
class L1SeasonTest extends TestCase
{
    use FactoryTrait;

    public function testCreateSpring()
    {
        $season = $this->createSeason('2001-21');

        $this->assertSame(2001, $season->getYear());
    }
}