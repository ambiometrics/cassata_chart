<?php
declare(strict_types=1);

namespace test\edwrodrig\cassata_chart;

use edwrodrig\cassata_chart\Range;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{

    public function testRange()
    {
        $range = new Range(0, 100, 100);
        $this->assertEquals(50, $range->transform(50));
    }

    public function testRangeScaled()
    {
        $range = new Range(0, 100, 50);
        $this->assertEquals(25, $range->transform(50));
    }

    public function testRangeOffset()
    {
        $range = new Range(50, 100, 50);
        $this->assertEquals(0, $range->transform(50));
    }

    public function testRangeOffsetScaled()
    {
        $range = new Range(50, 100, 50);
        $this->assertEquals(25, $range->transform(75));
    }

}
