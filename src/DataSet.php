<?php
declare(strict_types=1);

namespace edwrodrig\cassata_chart;


class DataSet
{
    private array $data = [];

    private array $order;

    private array $orderMap;

    public function __construct(array $order = []) {
        $this->order = $order;
        $this->orderMap = array_fill_keys($order, 0);
    }

    public function addValue(float $x, string $class, float $value) : self {
        if ( !isset($this->data[$x]) )
            $this->data[$x] = $this->orderMap;

        $this->data[$x][$class] = $value;
        return $this;
    }

    public function sort() {
        if ( empty($this->order) ) {
            $this->order = array_keys($this->data[array_key_first($this->data)]);
        }
        ksort($this->data);
    }

    public function searchX(float $x)  {
        $last = null;
        foreach ( $this->data as $key => $value ) {
            if ( $x < $key ) {
                if ( $last == null ) return null;
                else return [$last, $key];
            } else if ( $key == $x ) {
                return [$x, $x];
            }
            $last = $key;
        }
        return null;
    }

    public function getVirtualRow(float $x) {
        $result = $this->searchX($x);
        if ( is_null($result) ) return null;
        if  ( $result[0] == $result[1] ) {
            return $this->data[$result[0]];
        }

        $deltaX = $result[1] - $result[0];
        $row = [
            $this->data[$result[0]],
            $this->data[$result[1]]
        ];

        $virtualRow = [];
        foreach ( $row[0] as $key => $value ) {
            $deltaY = $row[1][$key] - $row[0][$key];
            $m = $deltaY / $deltaX;
            $virtualRow[$key] = $m * ($x - $result[0]) + $row[0][$key];
        }
        return $virtualRow;

    }

    public function diff(DataSet $other) : DataSet {
        $keys1 = array_keys($this->data);
        $keys2 = array_keys($other->data);
        $keys = array_merge($keys1, $keys2);
        $keys = array_unique($keys);
        sort($keys);

        $diff = new DataSet($this->order);
        foreach ( $keys as $key ) {
            $row1 = $this->getVirtualRow($key);
            $row2 = $other->getVirtualRow($key);

            if ( is_null($row1) ) continue;
            if ( is_null($row2) ) continue;
            foreach ( $this->order as $class ) {
                $diff->addValue($key, $class, abs($row1[$class] - $row2[$class]));
            }
        }
        return $diff;
    }

    public function getDataValues() : DataValues {
        $values = new DataValues();
        foreach ( $this->data as $key => $value ) {
            $column = new StackedValues(strval($key), $key, ...array_values($value));
            $values->setStackedValues($column);
        }
        return $values;
    }

    public function getOrder() : array {
        return $this->order;
    }

}