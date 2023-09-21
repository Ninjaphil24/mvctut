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
        if ($statement->execute()) return 0;
        else if ($con->errno==1062) return 1062;
        else if ($con->errno==3819) return 3819;
    }
}
