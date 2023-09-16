<?php

namespace UserModelNamespace;

class UserModel
{

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
        $statement->execute();
        return $con->errno;
    }
}
