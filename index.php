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
    $router->dispatch();
    // echo "<br> print_r(\$_GET): ";
    // print_r($_GET);
    // echo "<br> \$_SERVER['REQUEST_URI']: ";
    // echo $_SERVER['REQUEST_URI'];
    // echo "<br> parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH): ";
    // echo $router->uri;
    ?>
</body>

</html>