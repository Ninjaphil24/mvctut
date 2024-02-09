<?php

namespace UserControllerSpace;

use UserModelNamespace\UserModel;

class UserController
{
    private $con;
    public function __construct()
    {
        global $con;
        $this->con = $con;        
    }
    function home()
    {
        require_once(__DIR__.'\..\views\home.php');
    }
    function create()
    {
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $store = new UserModel;
            $errorMsg = $store->createUser($this->con, $first_name, $last_name, $email);
            if ($errorMsg==="") require_once(__DIR__.'\..\views\success.php');
            else require_once(__DIR__.'\..\views\home.php');
        }
    }
}
