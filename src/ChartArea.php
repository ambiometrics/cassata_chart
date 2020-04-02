<?php
declare(strict_types=1);

namespace edwrodrig\lasagna_chart;


class ChartArea
{
    const MODE_NORMAL = 0;
    const MODE_DEPTH = 1;

    private Range $x;
    private Range $y;

    private Palette $palette;

    private int $mode = self::MODE_NORMAL;

    public function __construct(Range $x, Range $y) {
        $this->x = $x;
        $this->y = $y;

        $this->palette = new Palette;
    }

    public function setMode(int $mode) {
        $this->mode = $mode;
    }

    public function transformCoord(array $coord) : array {
        if ( $this->mode == self::MODE_NORMAL ) {
            return [
                $this->x->transform($coord[0]),
                $this->y->transform($coord[1])
            ];
        } else {
            return [
                $this->y->transform($coord[1]),
                $this->x->transform($coord[0])
            ];
        }
    }

    public function transformCoords(array $coords) : array {
        $transformedCoords = [];
        foreach ( $coords as $coord ) {
            $transformedCoords[] = $this->transformCoord($coord);
        }
        return $transformedCoords;
    }

    public function setPalette(Palette $palette) {
        $this->palette = $palette;
    }

    public function draw(DataValues $data, int $x, int $y) {
        echo sprintf("<svg x=%d y=%d>", $x, $y);
        echo Svg::drawPolygon($this->transformCoords($data->getPolygonCoords(0)), $this->palette->getColor($data->getStackedValues(0)->getLabel()));
        echo Svg::drawPolygon($this->transformCoords($data->getPolygonCoords(1)), $this->palette->getColor($data->getStackedValues(1)->getLabel()));
        echo sprintf("</svg>");
    }
}