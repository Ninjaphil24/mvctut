<?php

namespace UserModelNamespace;

use Exception;

class ListModel
{
    public function list($con)
    {
        try {
            $sql = "SELECT * FROM users";
            $result = $con->query($sql);
            if($con->error) throw new Exception("Database Error: " . $con->error);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function single($con, $id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                "s",
                $id
            );
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($con->error) throw new Exception("Database Error: " . $con->error);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
