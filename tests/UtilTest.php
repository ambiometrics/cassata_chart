<?php
declare(strict_types=1);

namespace test\edwrodrig\lasagna_chart;

use edwrodrig\lasagna_chart\Util;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;
use Exception;

class UtilTest extends TestCase
{

    private vfsStreamDirectory $root;

    public function setUp() : void {
        $this->root = vfsStream::setup();
    }

    public function testSum() {
        $result = Util::sum(1,2);
        $this->assertEquals(3, $result);
    }

    public function testException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Random message");
        $this->expectExceptionCode(10);
        throw new Exception("Random message", 10);
    }

    public function testFile() {
        $path = $this->root->url();
        $filename = $path . "/file";
        file_put_contents($filename, "hola como te va");
        $this->assertFileExists($filename);
        $contents = file_get_contents($filename);
        $this->assertEquals("hola como te va", $contents);
    }


}
