<?php
$errorbool1 = false;
$errorbool2 = false;
class UserController
{
    function create($con)
    {
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $store = new UserModel;
            $store->createUser($con, $first_name, $last_name, $email);
        }
    }

    function success()
    {
        require_once('app/views/success.php');
    }
}