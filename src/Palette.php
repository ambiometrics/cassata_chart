<?php
declare(strict_types=1);

namespace edwrodrig\cassata_chart;

class Palette
{
    private array $colors;

    public function __construct(array $colors = []) {

        $this->colors = $colors;
    }

    public function getColor(int $index) : string {
        if ( isset($this->colors[$index])) {
            return $this->colors[$index];
        } else {
            $hex = md5("fnjdnwea" . $index);
            return "#" . substr($hex, 0, 6);
        }
    }
}