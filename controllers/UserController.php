<?php
$errorbool1 = false;
$errorbool2 = false;

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    createUser($con, $first_name, $last_name, $email);    
}