<?php

namespace RouterSpace;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;
trait RouterSetup
{
    public $routes = [];
    private function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];       
    }

    public function createRoutes()
    {
        $this->addRoutes('/', UserController::class, 'home');
        $this->addRoutes('/index.php', UserController::class, 'create');
        $this->addRoutes('/list', ListController::class, 'listusers');
    }
}