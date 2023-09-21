<?php

namespace UserModelNamespace;

use UserModelNamespace\DuplicateEmail;
use UserModelNamespace\EmptyEmailField;

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

        try {
            if ($statement->execute()) return 0;
            else
                switch ($con->errno) {
                    case 0:
                        return 0;
                        break;
                    case 1062:
                        throw new DuplicateEmail;
                        break;
                    case 3819:
                        throw new EmptyEmailField;
                        break;
                }
        } catch (DuplicateEmail $e) {
            return 1062;
        } catch (EmptyEmailField $e) {
            return 3819;
        }
    }
}
