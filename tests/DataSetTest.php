<?php

namespace test\edwrodrig\cassata_chart;

use edwrodrig\cassata_chart\DataSet;
use PHPUnit\Framework\TestCase;

class DataSetTest extends TestCase
{
    public function testSearchX()
    {
        $dataSet = new DataSet(['a']);

        $dataSet->addValue(1, 'a', 6);
        $dataSet->addValue(3, 'a', 2);
        $dataSet->sort();


        $this->assertEquals(null, $dataSet->searchX(0));
        $this->assertEquals([1, 1], $dataSet->searchX(1));

        $this->assertEquals([1, 3], $dataSet->searchX(2));
        $this->assertEquals([1, 3], $dataSet->searchX(2.5));
        $this->assertEquals([3, 3], $dataSet->searchX(3));

        $this->assertEquals(null, $dataSet->searchX(4));

    }


    public function testGetVirtualRow()
    {
        $dataSet = new DataSet(['a']);

        $dataSet->addValue(1, 'a', 6);
        $dataSet->addValue(3, 'a', 2);
        $dataSet->sort();

        $row = $dataSet->getVirtualRow(2);
        $this->assertEquals(['a' => 4], $row);

        $row = $dataSet->getVirtualRow(2.5);
        $this->assertEquals(['a' => 3], $row);

        $row = $dataSet->getVirtualRow(3);
        $this->assertEquals(['a' => 2], $row);

        $row = $dataSet->getVirtualRow(1);
        $this->assertEquals(['a' => 6], $row);
    }

    public function testDiff() {
        $order = ['a'];
        $dataSet1 = new DataSet($order);
        $dataSet1->addValue(1, 'a', 6);
        $dataSet1->addValue(3, 'a', 2);
        $dataSet1->sort();

        $dataSet2 = new DataSet($order);

        $dataSet2->addValue(2, 'a', 3);
        $dataSet2->sort();

        $dataSetDiff = $dataSet1->diff($dataSet2);
        $this->assertEquals([2,2], $dataSetDiff->searchX(2));
        $this->assertEquals(['a' => 1], $dataSetDiff->getVirtualRow(2));
    }
}
