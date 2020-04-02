<?php
declare(strict_types=1);

use edwrodrig\lasagna_chart\Svg;

require_once(__DIR__ . '/../vendor/autoload.php');
echo "<svg xmlns=\"http://www.w3.org/2000/svg\">";
echo Svg::drawPolygon([[0,0], [100, 00], [100, 100]], "#FF0000");
echo "</svg>";
