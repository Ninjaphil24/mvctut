<?php

namespace RouterSpace;

class Routes
{
    private $routes = [];
    public function addRoutes($uri, $controller, $method)
    {

        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
        if (array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            if (class_exists($controller)) {
                $method = $this->routes[$uri]['method'];
                $inst = new $controller;
                if (method_exists($inst, $method)) {
                    $inst->$method();
                } else echo "Method does not exist!";
            } else echo "Classname does not exist!";
        } else echo "URI does not exist!";
    }
}
