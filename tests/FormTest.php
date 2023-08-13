<?php

use \PHPUnit\Framework\TestCase;

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

        $this->assertTrue($result);
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

        $this->assertFalse($result);
        $this->deleteRow();
    }

    public function deleteRow()
    {
        $query = "DELETE FROM users WHERE email = 'john@smith.com'";
        $this->con->query($query);
    }    
}
