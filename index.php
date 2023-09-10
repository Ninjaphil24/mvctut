<?php
require_once('env.php');
require_once('mysqlconnect.php');
require_once('models/UserModel.php');
require_once('controllers/UserController.php');


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
    <div class="box">
        <form action="index.php" method="post">
            <div class="inputBox">
                <input type="text" id="first_name" name="first_name" required>
                <label for="first_name">First Name</label>
            </div>
            <div class="inputBox">
                <input type="text" id="last_name" name="last_name" required>
                <label for="last_name">Last Name</label>
            </div>
            <div class="inputBox">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
                <?php if ($errorbool1) echo '<div style="color: red;">Your email is already being used!</div> <br> <br>';
                else if ($errorbool2) echo '<div style="color: red;">This field cannot be empty!</div> <br> <br>';
                ?>
            </div>
            <div class="inputBox">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>