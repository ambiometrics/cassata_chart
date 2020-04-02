<?php
declare(strict_types=1);

use edwrodrig\lasagna_chart\Util;

require_once(__DIR__ . '/../vendor/autoload.php');

$result = Util::sum(4, 5);
echo $result , "\n";
