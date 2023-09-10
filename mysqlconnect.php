<?php
try {
    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
        throw new Exception("Error" . $con->connect_error);
    }
} catch (Exception $ex) {
    error_log($ex->getMessage());
    echo "Cannot connect at this time!";
}