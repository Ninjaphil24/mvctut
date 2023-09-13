<?php

require "vendor/autoload.php";
use UserControllerSpace\UserController;
use UserModelNamespace\UserModel;

require_once('env.php');
require_once('mysqlconnect.php');
// require_once('app/models/UserModel.php');
// require_once('app/controllers/UserController.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Vanilla Form</title>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_URI'] == "/") {
        $home = new UserController($errorbool1,$errorbool2);
        $home->home();
    }
    else if ($_SERVER['REQUEST_URI'] == "/index.php" && $_SERVER['REQUEST_METHOD']=='POST'){
        $creator = new UserController($errorbool1,$errorbool2);
        $creator->create($con,$errorbool1,$errorbool2);
    }        
    else if ($_SERVER['REQUEST_URI'] == "/index.php" && $_SERVER['REQUEST_METHOD']=='GET'){
        $success = new UserController($errorbool1,$errorbool2);
        $success->success();
    }
    $errors = new UserModel;
    if ($errorbool1) {
        $home = new UserController($errorbool1,$errorbool2);
        $home->home();
    }
    ?>

    <pre style="position: absolute; bottom: 0; left: 5px;">
    <?php var_dump($errorbool1);?>
    
    Method: <?php echo $_SERVER['REQUEST_METHOD']; ?>
    <br><br> 
    URI: <?php echo $_SERVER['REQUEST_URI']; ?></pre>
    
</body>

</html>