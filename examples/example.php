<?php
declare(strict_types=1);

use edwrodrig\cassata_chart\ChartArea;
use edwrodrig\cassata_chart\Config;
use edwrodrig\cassata_chart\DataSet;
use edwrodrig\cassata_chart\Legend;
use edwrodrig\cassata_chart\Range;

require_once(__DIR__ . '/../vendor/autoload.php');

$config = new Config(json_decode(file_get_contents(__DIR__ . '/config.json'), true));

$data1 = new DataSet(['a', 'b', 'c']);
$data1
    ->addValue(1,  'a', 0.25)
    ->addValue(1, 'b', 0.25)
    ->addValue(1, 'c', 0.5)

    ->addValue(2,  'a', 0.50)
    ->addValue(2, 'b', 0.25)
    ->addValue(2, 'c', 0.25)

    ->addValue(3,  'a', 0.10)
    ->addValue(3, 'b', 0.30)
    ->addValue(3, 'c', 0.60);

$data2 = new DataSet(['a', 'b', 'c']);
$data2
    ->addValue(1,  'a', 0.15)
    ->addValue(1, 'b', 0.35)
    ->addValue(1, 'c', 0.5)

    ->addValue(3,  'a', 0.50)
    ->addValue(3, 'b', 0.25)
    ->addValue(3, 'c', 0.25)

    ->addValue(7,  'a', 0.20)
    ->addValue(7, 'b', 0.40)
    ->addValue(7, 'c', 0.40);


$data3 = $data1->diff($data2);

$values1 = $data1->getDataValues();
$values2 = $data2->getDataValues();
$values3 = $data3->getDataValues();

$area = new ChartArea(
    new Range(0, 7, 100),
    new Range(0, 1, 100)
);
$area->setMode(ChartArea::MODE_DEPTH);
$area->setPalette($config->getPalette());

$legend = new Legend($config->getData());

header('Content-type: image/svg+xml');
?><?xml version="1.0" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
    "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="3000" height="1200" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <?php
    $area->draw($values1, 200, 100 );
    $area->draw($values2, 400, 100);
    $area->draw($values3, 600, 100);
    $legend->draw(1000, 100);
    ?>
</svg>
