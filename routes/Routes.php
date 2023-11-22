<?php

namespace RouterSpace;

use Exception;
use RouterSpace\RouterSetup;
use RouterSpace\RoutesInterface;

class Routes implements RoutesInterface
{
    // Variable $uri and constructor syntax are set like this to assist testing
    public $uri;
    public function __construct($uri1 = null)
    {
        $this->uri = $uri1 ?? (isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : null);
    }
    use RouterSetup;
    public $routes = [];
    public $matches = [];

    public function dispatch(): void
    {
        $this->createRoutes();
        try {
            $routeBool = false;
            foreach ($this->routes as $route => $nested) {
                $route = str_replace(":id", "([0-9]+)",$route);
                if (preg_match("#^$route$#", $this->uri, $matches)) {
                    $routeBool=true;
                    $controller = $nested['controller'];
                    $method = $nested['method'];
                    array_shift($matches);
                    // Used for debugging and testing
                    // echo "<pre>";
                    // echo "Matches:";
                    // print_r($matches);
                    // echo $matches ? "true <br>" : "false<br>";
                    // echo "Route: ". $route;
                    // echo "</pre>";
                    if (!class_exists($controller)) throw new Exception("Classname does not exist!");
                    else $inst = new $controller;
                    if (!method_exists($inst, $method)) throw new Exception("Method does not exist!");
                    else $inst->$method(...$matches);
                    return;
                } 
            }    
            if (!$routeBool) throw new Exception("URI does not exist!");

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
