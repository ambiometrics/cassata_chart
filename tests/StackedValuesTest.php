<?php
declare(strict_types=1);

namespace test\edwrodrig\cassata_chart;

use edwrodrig\cassata_chart\StackedValues;
use PHPUnit\Framework\TestCase;

class StackedValuesTest extends TestCase
{
    public function testStackedValues()
    {
        $values = new StackedValues("label", 5);
        $values->stackValue(1);
        $values->stackValue(3);

        $this->assertEquals(0, $values->getValue(-1));
        $this->assertEquals(1, $values->getValue(0));
        $this->assertEquals(4, $values->getValue(1));

        $this->assertEquals([5, 0], $values->getStartCoord(0));
        $this->assertEquals([5, 1], $values->getEndCoord(0));
        $this->assertEquals([5, 1], $values->getStartCoord(1));
        $this->assertEquals([5, 4], $values->getEndCoord(1));

    }
}
