<?php

declare(strict_types=1);

namespace EDTF\Tests\Unit;

use EDTF\Interval;
use EDTF\Parser;
use PHPUnit\Framework\TestCase;

/**
 * Class L1UnspecifiedTest
 *
 * @covers \EDTF\Interval
 * @covers \EDTF\Parser
 * @package EDTF\Tests\Unit
 */
class L1UnspecifiedTest extends TestCase
{
    use FactoryTrait;

    public function testOneDigitYear()
    {
        $date = $this->createInterval('199X');

    }
}
