<?php

namespace RouterSpace;

use Exception;
use RouterSpace\RouterSetup;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;

class Routes
{
    use RouterSetup;

    public function dispatch()
    {
        $this->createRoutes();
        try {
            if (!array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) throw new Exception("URI does not exist!");
            $controller = $this->routes[$_SERVER['REQUEST_URI']]['controller'];
            if (!class_exists($controller)) throw new Exception("Classname does not exist!");
            $method = $this->routes[$_SERVER['REQUEST_URI']]['method'];
            $inst = new $controller;
            if (!method_exists($inst, $method)) throw new Exception("Method does not exist!");
            $inst->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
