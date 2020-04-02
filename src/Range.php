<?php
declare(strict_types=1);

namespace edwrodrig\cassata_chart;

class Range {


    private float $min;
    private float $max;

    private float $dimension;
    private float $scale;

    public function __construct(float $min, float $max, float $dimension) {
        $this->min = $min;
        $this->max = $max;

        $this->dimension = $dimension;

        $this->scale = $dimension / ($max - $min);
    }


    public function transform(float $value) : float {
        return $this->translate($value) * $this->scale;
    }

    private function translate(float $value) : float {
        return $value - $this->min;
    }

    public function getStart() : float {
        return 0;
    }

    public function getEnd() : float {
        return $this->dimension;
    }
}