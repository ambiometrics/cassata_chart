<?php
declare(strict_types=1);

namespace edwrodrig\lasagna_chart;

class DataValues
{

    /**
     * @var StackedValues[]
     */
    private array $columns = [];

    public function setStackedValues(StackedValues $column) {
        $this->columns[] = $column;
    }

    public function getStackedValues(int $index) : StackedValues {
        return $this->columns[$index];
    }

    public function getPolygonCoords(int $index) : array {
        $tail = [];
        $head = [];
        foreach ( $this->columns as $column ) {
            $head[] = $column->getStartCoord($index);
            array_unshift($tail, $column->getEndCoord($index));
        }

        return array_merge($head, $tail);
    }

    public function getColumnCoords() : array {
        $coords = [];
        foreach ( $this->columns as $column ) {
            $coords[] = $column->getStartCoord(0);
        }
        return $coords;
    }

}