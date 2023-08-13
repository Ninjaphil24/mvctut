<?php

use \PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testConnection()
    {

        $con = new mysqli("localhost","mphil","","mvctut");
    }
}
