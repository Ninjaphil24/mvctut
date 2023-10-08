<?php

namespace RouterSpace;

use Exception;
use RouterSpace\RouterSetup;
use RouterSpace\RoutesInterface;

class Routes implements RoutesInterface
{
    // Variable $uri and constructor syntax are set like this to assist testing
    public $uri;
    public function __construct($uri1=null)
    {
        $this->uri = $uri1 ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH):null);
    }
    use RouterSetup;
    public $routes = [];

    public function dispatch():void
    {
        $this->createRoutes();
        try {
            if (!array_key_exists($this->uri, $this->routes)) throw new Exception("URI does not exist!");
            $controller = $this->routes[$this->uri]['controller'];
            if (!class_exists($controller)) throw new Exception("Classname does not exist!");
            $method = $this->routes[$this->uri]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method does not exist!");
            $inst->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
