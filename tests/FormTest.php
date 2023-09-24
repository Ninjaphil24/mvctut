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

        $this->assertTrue($result, "If this test has failed, check database for entry with email john@smith.com and delete!");
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

        $this->assertFalse($result, "If this test has failed, check database for entry with email john@smith.com and delete!");
        $this->deleteRow();
    }

    public function testFormSubmissionMock()
    {
        $con = $this->createMock(mysqli::class);
        $stmt = $this->createMock(mysqli_stmt::class);
        $first_name = "John";
        $last_name = "Smith";
        $email = "john@smith.com";
        $query = "INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)";
        $con->expects($this->once())
            ->method('prepare')
            ->with($query)
            ->willReturn($stmt);
        $stmt->expects($this->once())
            ->method('bind_param')
            ->with("sss", $first_name, $last_name, $email)
            ->willReturn(true);
        $stmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $query = new UserModel;
        $errorMsg = $query->createUser($con, 'John', 'Smith', 'john@smith.com');
        $this->assertEquals('', $errorMsg, "If this test has failed, check database for entry with email john@smith.com and delete!");
    }

    public function testFormSubmissionIntegration()
    {
        $query = new UserModel;
        $errorMsg = $query->createUser($this->con, 'John', 'Smith', 'john@smith.com');
        $this->assertEquals('', $errorMsg, "If this test has failed, check database for entry with email john@smith.com and delete!");
    }

    public function testForDuplicateEmailIntegration()
    {
        $query = new UserModel;
        $errorMsg = $query->createUser($this->con, 'John', 'Smith', 'john@smith.com');
        $this->assertEquals('Your email is already being used!', $errorMsg, "If this test has failed, check database for entry with email john@smith.com and delete!");
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
        $errorMsg = $query->createUser($this->con, 'John', 'Smith', '');
        $this->assertEquals('This field cannot be empty!', $errorMsg);
    }
}
