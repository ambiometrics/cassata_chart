<?php
declare(strict_types=1);

namespace edwrodrig\cassata_chart;


class Legend
{
    public array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function draw(float $x, float $y) {
        $currentY = 0;
        $squareSize = 14;
        $textOffset = $squareSize / 2;
        $spacing = $squareSize + 4;
        echo sprintf('<g transform="translate(%s %s)">', $x, $y);
        foreach ( $this->data as $name => $color ) {
            //echo Svg::drawSquare([0, $currentY], $squareSize, $color);
            echo Svg::drawCircle([0, $currentY], $squareSize, $color);
            echo Svg::drawTextAlignStart([10, $currentY + $textOffset], $name);
            $currentY += $spacing;
        }
        echo '</g>';
    }
}