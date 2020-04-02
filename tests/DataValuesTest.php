<?php
declare(strict_types=1);

namespace test\edwrodrig\cassata_chart;

use edwrodrig\cassata_chart\DataValues;
use edwrodrig\cassata_chart\StackedValues;
use PHPUnit\Framework\TestCase;

class DataValuesTest extends TestCase
{

    public function testGetPolygonCoords()
    {
        $data = new DataValues();
        $data->setStackedValues(new StackedValues("a1", 1, 0.25, 0.25, 0.5));
        $data->setStackedValues(new StackedValues("a2", 2, 0.50, 0.25, 0.25));
        $this->assertEquals(
            [
                [1,0],
                [2,0],
                [2,0.5],
                [1,0.25]
            ],
            $data->getPolygonCoords(0));

        $this->assertEquals(
            [
                [1,0.25],
                [2,0.50],
                [2,0.75],
                [1,0.50]
            ],
            $data->getPolygonCoords(1));


    }
}
