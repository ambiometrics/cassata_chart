<?php
declare(strict_types=1);

namespace test\edwrodrig\cassata_chart;

use edwrodrig\cassata_chart\Svg;
use PHPUnit\Framework\TestCase;

class SvgTest extends TestCase
{

    public function testDrawPolygon()
    {
        $this->assertEquals(
            "<polygon points=\"0,0,100,0,100,100\" style=\"fill:#FF0000;stroke:none;stroke-width:0;\"><title>#FF0000</title></polygon>",
            Svg::drawPolygon([[0,0], [100, 00], [100, 100]], "#FF0000")
        );
    }
}
