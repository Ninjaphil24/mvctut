<?php

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\UserController;

class RoutesTest extends TestCase
{
    public function testRouteSuccessIntegration()
    {
        $routes = new Routes;
        $routes->uri = '/';
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('<div class="box">', $contents);
    }

    public function testRouteUriExceptionIntegration()
    {
        $routes = new Routes;
        $routes->uri = '/broken';
        $controller = new UserController;
        ob_start();
        $routes->dispatch();
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('URI does not exist!', $contents);
    }

    public function testRouteControllerExceptionIntegration()
    {
        
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri = '/';
        $routesMock->expects($this->once())
            ->method('createRoutes')
            ->willReturn($routesMock->routes = ['/' => ['controller' => 'Broken', 'method' => 'broken']]);

        ob_start();
        $routesMock->dispatch();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Classname does not exist!', $contents);
    }

    public function testRouteMethodExceptionIntegration()
    {
        $routesMock = $this->createPartialMock(Routes::class, ['createRoutes']);
        $routesMock->uri = '/';
        $routesMock->expects($this->once())
            ->method('createRoutes')
            ->willReturnCallback(function () use ($routesMock) {
                $routesMock->routes = ['/' => ['controller' => 'UserControllerSpace\UserController', 'method' => 'broken']];
            });

        ob_start();
        $routesMock->dispatch();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Method does not exist!', $contents);
    }
}