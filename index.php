<?php
require "vendor/autoload.php";
use UserControllerSpace\UserController;
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
    if ($_SERVER['REQUEST_URI'] == "/") {
        $home = new UserController;
        $home->home();
    }
    else if ($_SERVER['REQUEST_URI'] == "/index.php"){
        $creator = new UserController;
        $result = $creator->create($con);
        return $result;
    }
    ?>

    <pre style="position: absolute; bottom: 0; left: 5px;">
    Error: <?php echo $result; ?>
    Method: <?php echo $_SERVER['REQUEST_METHOD']; ?>
    <br><br> 
    URI: <?php echo $_SERVER['REQUEST_URI']; ?></pre>
    
</body>

</html>