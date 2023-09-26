<?php

use \PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    private $con;

    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "mphil", "", "mvctut");
    }

    public function testConnection()
    {
        $result = $this->con->errno === 0;

        $this->assertTrue($result);
    }

    public function testIndexOutput() 
    {
        ob_start();
        require("index.php");
        $contents = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString('<body>',$contents);
    }

    protected function tearDown(): void
    {
        $this->con->close();
    }
}
