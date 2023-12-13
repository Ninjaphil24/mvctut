<?php

namespace UserControllerSpace;

use Exception;
use UserModelNamespace\ListModel;

class ListController
{
    // Variable $con and constructor syntax are set like this to assist testing
    public $con;
    public $uri;
    public function __construct($uri1 = null,$con1 = null)
    {
        $this->uri = $uri1 ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->con = $con1 ?? $GLOBALS['con'];
    }
    public function listusers()
    {
        $uri = $this->uri;
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
        $uri = $this->uri;
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
    public function singleuser($id=NULL)
    {
        $id = $id ?? $_GET["id"];
        $uri = $this->uri;
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiation failure!");
            $rows = $result->single($this->con,$id);
            if (!$rows) throw new Exception("Method failure!");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function singleuserfa($id=NULL)
    {
        $id = $id ?? $_GET["id"];
        $uri = $this->uri;
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiation failure!");
            $result = $inst->single($this->con,$id);
            if (!$result) throw new Exception("Method failure!");
            $row = $result->fetch_assoc();
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function singleuserfawc($id)
    {
        $uri = $this->uri;
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
