<?php


namespace edwrodrig\cassata_chart;


class Svg
{
    public static function drawPolygon(array $coords, string $color, ?string $tooltip = null) : string {
        $points = self::serializeCoords($coords);

        return sprintf('<polygon points="%s" style="fill:%s;stroke:none;stroke-width:0;"><title>%s</title></polygon>', $points, $color, $tooltip ?? $color);
    }

    public static function drawLine(array $coords, string $color) : string {
        return sprintf('<line x1="%s" y1="%s" x2="%s" y2="%s" stroke="%s" stroke-width="1px"/>',
            $coords[0][0],
            $coords[0][1],
            $coords[1][0],
            $coords[1][1],
            $color);
    }

    public static function drawSquare(array $coord, float $size, string $color) : string {
        return sprintf(
            '<rect fill="%s" stroke="none" stroke-width="0" x="%s" y="%s" width="%s" height="%s"/>',
            $color,
            $coord[0],
            $coord[1],
            $size,
            $size
            );
    }

    public static function drawCircle(array $coord, float $size, string $color) : string {
        $radius = $size / 2;
        return sprintf(
            '<circle fill="%s" stroke="none" stroke-width="0" cx="%s" cy="%s" r="%s"/>',
            $color,
            $coord[0] + $radius,
            $coord[1] + $radius,
            $radius
        );
    }


    public static function drawTextAlignEnd(array $coord, string $text, ?string $tooltip = null) {
        return sprintf('<text text-anchor="end" font-family="Arial" font-size="15px" x="%s" y="%s">%s<title>%s</title></text>', $coord[0] - 15, $coord[1] + 4, $text, $tooltip ?? $text);
    }

    public static function drawTextAlignStart(array $coord, string $text) {
        return sprintf('<text font-family="Arial" font-size="15px" x="%s" y="%s">%s</text>', $coord[0] + 15, $coord[1] + 4, $text);
    }

    private static function serializeCoords(array $coords) : string {
        $numbers = [];
        foreach ( $coords as $coord) {
            $numbers[] = $coord[0];
            $numbers[] = $coord[1];
        }
        return implode(",", $numbers);
    }
}