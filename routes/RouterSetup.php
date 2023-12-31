<?php

namespace RouterSpace;
use UserControllerSpace\ListController;
use UserControllerSpace\UserController;
trait RouterSetup
{
    private function addRoutes($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];       
    }

    protected function createRoutes()
    {
        $this->addRoutes('/', UserController::class, 'home');
        $this->addRoutes('/index.php', UserController::class, 'create');
        $this->addRoutes('/list', ListController::class, 'listusers');
        $this->addRoutes('/listfa', ListController::class, 'listusersfa');
        $this->addRoutes('/singleuser', ListController::class, 'singleuser');
        $this->addRoutes('/singleuserfa', ListController::class, 'singleuserfa');
    }
}