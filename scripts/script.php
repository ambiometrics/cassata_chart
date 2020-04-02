<?php
declare(strict_types=1);

use edwrodrig\lasagna_chart\ChartArea;
use edwrodrig\lasagna_chart\DataValues;
use edwrodrig\lasagna_chart\Range;
use edwrodrig\lasagna_chart\StackedValues;
use edwrodrig\lasagna_chart\Svg;

require_once(__DIR__ . '/../vendor/autoload.php');

$data = new DataValues();
$data->setStackedValues(new StackedValues("a1", 1, 0.25, 0.25, 0.5));
$data->setStackedValues(new StackedValues("a2", 2, 0.50, 0.25, 0.25));

$area = new ChartArea(new Range(0, 1, 100), new Range(0, 1, 100));
$area->setMode(ChartArea::MODE_DEPTH);


echo "<svg width=200 height=200 xmlns=\"http://www.w3.org/2000/svg\">";
$area->draw($data, 0, 0 );
$area->draw($data, 250, 0);
echo "</svg>";
