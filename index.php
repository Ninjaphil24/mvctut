<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('app/models/UserModel.php');
require_once('app/controllers/UserController.php');
$creator = new UserController;
$creator->create($con);

// echo '<pre>';
// var_dump($_POST['first_name']);
// var_dump($last_name);
// var_dump($email);
// echo '</pre>';

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
    if ($_SERVER['REQUEST_URI'] == "/index.php") $creator->success();
    else require_once('app/views/home.php');



    echo '<pre style="position: absolute; bottom: 0; left: 5px;">';
    echo 'Method: ' . $_SERVER['REQUEST_METHOD'];
    echo '<br><br> URI: ' . $_SERVER['REQUEST_URI'] . '</pre>';
    ?>
</body>

</html>