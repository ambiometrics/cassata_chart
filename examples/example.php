<?php
declare(strict_types=1);

use edwrodrig\lasagna_chart\ChartArea;
use edwrodrig\lasagna_chart\Config;
use edwrodrig\lasagna_chart\DataValues;
use edwrodrig\lasagna_chart\Range;
use edwrodrig\lasagna_chart\StackedValues;

require_once(__DIR__ . '/../vendor/autoload.php');

$config = new Config(json_decode(file_get_contents(__DIR__ . '/config.json'), true));

$data = new DataValues();
$data->setStackedValues(new StackedValues("a1", 1, 0.25, 0.25, 0.5));
$data->setStackedValues(new StackedValues("a2", 2, 0.50, 0.25, 0.25));
$data->setStackedValues(new StackedValues("a3", 3, 0.10, 0.30, 0.60));

$area = new ChartArea(new Range(0, 4, 100), new Range(0, 1, 100));
$area->setMode(ChartArea::MODE_DEPTH);
$area->setPalette($config->getPalette());

header('Content-type: image/svg+xml');
?><?xml version="1.0" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
    "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="1200" height="1200" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <?php
    $area->draw($data, 200, 100 );
    $area->draw($data, 400, 100);
    ?>
</svg>
