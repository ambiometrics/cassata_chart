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
        echo sprintf('<g transform="translate(%s %s)">', $x, $y);
        echo sprintf("<svg>");
        for ( $i = 0 ; $i < $data->countAreas() ; $i++ ) {
            echo Svg::drawPolygon($this->transformCoords($data->getPolygonCoords($i)), $this->palette->getColor($i));
        }
        echo sprintf("</svg>");
        foreach ( $data->iterateColumns() as $column ) {
            $coords = $this->transformCoords($column->getLineCoords());
            echo Svg::drawLine($coords, "#FFFFFF");
            echo Svg::drawTextAlignEnd($coords[0], $column->getLabel());
        }
        echo sprintf('</g>');

    }
}