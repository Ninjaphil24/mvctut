<?php

use RouterSpace\Routes;
use PHPUnit\Framework\TestCase;
use UserControllerSpace\ListController;
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

    public function testRoutesCaptureGroupIntegration()
    {
        $routes = new Routes;
        $routes->uri = '/singleuserfawc/15';
        $con = $this->createMock(mysqli::class);
        // $con = new mysqli("localhost", "mphil", "", "mvctut");

        $listctrl = new ListController($con);
        ob_start();
        $routes->dispatch();  
        $output = ob_get_clean();
        var_dump($con);
        // Use the following to see output from <pre> tags inside of dispatch method:
        echo $output;
        $this->assertIsArray($routes->dispatch());    
    }
    
    public function testRoutesCGIntegrRegexFail()
    {
        $routes = new Routes;
        $routes->uri = '/singleuserfawc/broken';
        $con = $this->createMock(mysqli::class);
        $listctrl = new ListController($con);
        ob_start();
        $routes->dispatch();  
        $output = ob_get_clean();
        // Use the following to see output from <pre> tags inside of dispatch method:
        // echo $output;
        $this->assertEquals("URI does not exist!",$output);    
    }
}