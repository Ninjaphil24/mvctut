<?php

namespace UserControllerSpace;

use UserModelNamespace\UserModel;

class UserController
{
    function home()
    {
        require_once('app/views/home.php');
    }
    function create($con)
    {
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $store = new UserModel;
            $result = $store->createUser($con, $first_name, $last_name, $email);
            switch ($result) {
                case 0:
                    require_once('app/views/success.php');
                    break;
                case 1062:
                    $error = '<div style="color: red;">Your email is already being used!</div> <br> <br>';
                    require_once('app/views/home.php');
                    break;
                case 3819:
                    $error = '<div style="color: red;">This field cannot be empty!</div> <br> <br>';
                    require_once('app/views/home.php');
                    break;
            }
        }
    }
}
