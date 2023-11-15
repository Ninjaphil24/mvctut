<?php

namespace UserControllerSpace;

use Exception;
use UserModelNamespace\ListModel;

class ListController
{
    private $con;
    public function __construct()
    {
        global $con;
        $this->con = $con;
    }
    public function listusers()
    {
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiation failure!");
            $rows = $result->list($this->con);
            if (!$rows) throw new Exception("Method failure!");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function listusersfa()
    {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiation failure!");
            $result = $inst->list($this->con);
            if (!$result) throw new Exception("Method failure!");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function singleuser()
    {
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiation failure!");
            $rows = $result->single($this->con,$_GET["id"]);
            if (!$rows) throw new Exception("Method failure!");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function singleuserfa()
    {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiation failure!");
            $result = $inst->single($this->con,$_GET["id"]);
            if (!$result) throw new Exception("Method failure!");
            $row = $result->fetch_assoc();
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function singleuserfawc()
    {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiation failure!");
            $result = $inst->singlewc($this->con,$id);
            if (!$result) throw new Exception("Method failure!");
            $row = $result->fetch_assoc();
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
