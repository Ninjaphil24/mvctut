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

    public function dispatch(): void
    {
        $this->createRoutes();
        echo "<pre>";
        // print_r($this->routes);
        echo "</pre>";
        try {
            // if (!array_key_exists($this->uri, $this->routes)) throw new Exception("URI does not exist!");
            foreach ($this->routes as $route => $nested) {
                if (preg_match("#^$route$#", $this->uri, $matches)) {
                    $controller = $nested['controller'];
                    $method = $nested['method'];
                    echo "<pre>";
                    print_r($matches);
                    print_r($nested);
                    echo "Controller: ".$controller."<br>";
                    echo "Method: ".$method."<br>";
                    echo "Uri: " . $this->uri . "<br>";
                    // echo "Controller: ".$controller;
                    echo "</pre>";
                    // if (!class_exists($controller)) throw new Exception("Classname does not exist!");
                    // $method = $this->routes[$this->uri]['method'];
                    // $inst = new $controller;
                    // if (!method_exists($inst, $method)) throw new Exception("Method does not exist!");
                    // $inst->$method();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
