<?php
declare(strict_types=1);

namespace edwrodrig\lasagna_chart;

class Palette
{
    private array $colors;

    public function __construct(array $colors = []) {

        $this->colors = $colors;
    }

    public function getColor(string $name) : string {
        if ( isset($this->colors[$name])) {
            return $this->colors[$name];
        } else {
            $hex = md5($name);
            return "#" . substr($hex, 0, 6);
        }
    }
}