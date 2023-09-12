<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('app/models/UserModel.php');
require_once('app/controllers/UserController.php');
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
    else if ($_SERVER['REQUEST_URI'] == "/index.php" && $_SERVER['REQUEST_METHOD']=='POST'){
        $creator = new UserController;
        $creator->create($con);
    }        
    else if ($_SERVER['REQUEST_URI'] == "/index.php" && $_SERVER['REQUEST_METHOD']=='GET'){
        $success = new RegisterSuccess;
        $success->success();
    }
    ?>

    <pre style="position: absolute; bottom: 0; left: 5px;">
    Method: <?php echo $_SERVER['REQUEST_METHOD']; ?>
    <br><br> 
    URI: <?php echo $_SERVER['REQUEST_URI']; ?></pre>
    
</body>

</html>