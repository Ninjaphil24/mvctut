<?php

namespace RouterSpace;

use Exception;

class Routes
{
    private $routes = [];
    public function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
        try {
            if (!array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) throw new Exception("URI does not exist!");
            $controller = $this->routes[$uri]['controller'];
            if (!class_exists($controller)) throw new Exception("Classname does not exist!");
            $method = $this->routes[$uri]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method does not exist!");
            $inst->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
