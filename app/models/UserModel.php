<?php

namespace UserModelNamespace;

use UserModelNamespace\DuplicateEmail;
use UserModelNamespace\EmptyEmailField;

class UserModel
{

    function createUser($con, $first_name, $last_name, $email, &$errorMsg)
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
            if ($statement->execute()) return true;
            else
                switch ($con->errno) {
                    case 1062:
                        throw new DuplicateEmail("Your email is already being used!");
                        break;
                    case 3819:
                        throw new EmptyEmailField("This field cannot be empty!");
                        break;
                }
        } catch (DuplicateEmail $e) {
            $errorMsg = $e->getMessage();
            return false;
        } catch (EmptyEmailField $e) {
            $errorMsg = $e->getMessage();
            return false;
        }
    }
}
