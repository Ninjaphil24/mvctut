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
            $errorMsg = "";
            $result = $store->createUser($con, $first_name, $last_name, $email, $errorMsg);
            if ($result) require_once('app/views/success.php');
            else require_once('app/views/home.php');
        }
    }
}
