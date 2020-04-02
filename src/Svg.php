<?php


namespace edwrodrig\lasagna_chart;


class Svg
{
    public static function drawPolygon(array $coords, string $color) : string {
        $points = self::serializeCoords($coords);

        return sprintf('<polygon points="%s" style="fill:%s;stroke:none;stroke-width:0;" />', $points, $color);
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