<?php

require "vendor/autoload.php";
use RouterSpace\Routes;
require_once('env.php');
require_once('mysqlconnect.php');
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
    $router = new Routes;
    $router->addRoutes('/','UserControllerSpace\UserController','home');    
    $router->addRoutes('/index.php','UserControllerSpace\UserController','create');
    ?>

    <pre style="position: absolute; bottom: 0; left: 5px;">
    
    URI: <?php
    //  echo $_SERVER['REQUEST_METHOD']; ?>
    Method: <?php print_r($router); ?>
    <br><br> 
    URI: <?php
    //  echo $_SERVER['REQUEST_URI']; ?></pre>
    
</body>

</html>