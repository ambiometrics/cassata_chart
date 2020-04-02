<?php
declare(strict_types=1);

namespace edwrodrig\lasagna_chart;


class ChartArea
{

    private Range $x;
    private Range $y;

    public function __construct(Range $x, Range $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function transformCoord(array $coord) : array {
        return [
            $this->x->transform($coord[0]),
            $this->y->transform($coord[1])
        ];
    }

    public function transformCoords(array $coords) : array {
        $transformedCoords = [];
        foreach ( $coords as $coord ) {
            $transformedCoords[] = $this->transformCoord($coord);
        }
        return $transformedCoords;
    }
}