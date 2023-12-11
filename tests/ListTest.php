<?php

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\ListController;

class ListTest extends TestCase
{
    private $con;

    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "mphil", "", "mvctut");
        $this->idNumberSetup();
        $this->createJohnSmith();
    }

    private $max_id;
    private function idNumberSetup()
    {
        $sql = "SELECT MAX(id) as max_id  FROM users";
        $result = $this->con->query($sql);
        $row = $result->fetch_assoc();
        $this->max_id = $row['max_id'];
    }

    private function createJohnSmith()
    {
        $_POST = [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john@smith.com',
            'submit' => 'Submit'
        ];

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $query = "INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)";

        $statement = $this->con->prepare($query);

        $statement->bind_param(
            "sss",
            $first_name,
            $last_name,
            $email
        );
        $statement->execute();
    }

    public function testListMethodResult()
    {
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $this->assertInstanceOf('mysqli_result', $result);
    }

    public function testListMethodContentSql()
    {
        $sql = "SELECT * FROM users ORDER BY id desc";
        $result = $this->con->query($sql);
        $row = $result->fetch_assoc();
        $this->assertEquals('John', $row['first_name']);
    }

    public function testListMethodContentWhile()
    {
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $lastrow = NULL;
        while ($row = $result->fetch_assoc()) {
            $lastrow = $row['first_name'];
        };
        $this->assertEquals('John', $lastrow);
    }

    public function testListMethodContentFetchAllForEach()
    {
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $lastrow = NULL;
        foreach ($rows as $row) $lastrow = $row['first_name'];
        $this->assertEquals('John', $lastrow);
    }

    public function testListMethodContentFetchAllEnd()
    {
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $last = end($rows);
        $this->assertEquals('John', $last['first_name']);
    }

    public function testIntListPageButtonForEach()
    {
        $_SERVER['REQUEST_URI']="/list";
        $controller = new ListController($this->con);
        ob_start();
        $controller->listusers();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Foreach', $contents);
    }
    
    public function testIntSingleUserPageButtonList()
    {
        $_SERVER['REQUEST_URI']="/singleuser?id=".$this->max_id;
        $_GET["id"] = $this->max_id;
        $controller = new ListController($this->con);
        ob_start();
        $controller->singleuser();
        $contents = ob_get_clean();
        $this->assertStringContainsString('List', $contents);
    }
    
    public function testIntSingleUserPageButtonListWC()
    {
        $_SERVER['REQUEST_URI']="/singleuserfawc/".$this->max_id;
        // $_GET["id"] = $this->max_id;
        $controller = new ListController($this->con);
        ob_start();
        $controller->singleuserfawc($this->max_id);
        $contents = ob_get_clean();
        $this->assertStringContainsString('List', $contents);
    }

    public function deleteRow()
    {
        $query = "DELETE FROM users WHERE email = 'john@smith.com'";
        $this->con->query($query);
    }

    private function idNumberTearDown()
    {
        $newMax = $this->max_id + 1;
        $sql = "ALTER TABLE users AUTO_INCREMENT = $newMax";
        $result = $this->con->query($sql);
    }

    protected function tearDown(): void
    {
        $this->deleteRow();
        $this->idNumberTearDown();
        $this->con->close();
    }
}
