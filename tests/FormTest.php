<?php

use \PHPUnit\Framework\TestCase;
use UserModelNamespace\UserModel;

class FormTest extends TestCase
{
    private $con;

    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "mphil", "", "mvctut");
    }

    public function testFormSubmission()
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

        $result = $statement->execute();

        $this->assertTrue($result, "If this test has failed, delete entry in database!");
    }

    public function testForDuplicateEmail()
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

        $result = $statement->execute();

        $this->assertFalse($result, "If this test has failed, delete entry in database!");
        $this->deleteRow();
    }

    public function testFormSubmissionFunc()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'John','Smith','john@smith.com');
        $this->assertEquals(0, $result, "If this test has failed, delete entry in database!");
    }

    public function testForDuplicateEmailFunc()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'John','Smith','john@smith.com');
        $this->assertEquals(1062, $result, "If this test has failed, delete entry in database!");
        $this->deleteRow();
    }
    public function deleteRow()
    {
        $query = "DELETE FROM users WHERE email = 'john@smith.com'";
        $this->con->query($query);
    }  
    public function testForEmptyEmailField()
    {
        $query = new UserModel;
        $result = $query->createUser($this->con, 'John','Smith','');
        $this->assertEquals(3819, $result);
    }
}
