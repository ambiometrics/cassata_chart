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

    public function getPolygonCoords(int $index) : array {
        $tail = [];
        $head = [];
        foreach ( $this->columns as $column ) {
            $head[] = $column->getStartCoord($index);
            array_unshift($tail, $column->getEndCoord($index));
        }

        return array_merge($head, $tail);
    }

    /**
     * @return \Generator|StackedValues[]
     */
    public function iterateColumns() {
        foreach ( $this->columns as $column ) {
            yield $column;
        }
    }

    public function countAreas() : int {
        if ( empty($this->columns)) return 0;
        return $this->columns[0]->count();
    }

}