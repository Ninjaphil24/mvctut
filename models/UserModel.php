<?php

function createUser($con, $first_name, $last_name, $email)
{

    $query = "INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)";

    $statement = $con->prepare($query);

    $statement->bind_param(
        "sss",
        $first_name,
        $last_name,
        $email
    );

    if ($statement->execute()) {
        header("Location: ./index.php");
        exit;
    } else if ($con->errno === 1062) $errorbool1 = true;
    else if ($con->errno === 3819) $errorbool2 = true;
}
