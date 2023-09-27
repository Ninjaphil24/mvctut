<?php

use RouterSpace\Routes;
use \PHPUnit\Framework\TestCase;
use UserControllerSpace\UserController;

class IndexTest extends TestCase
{
    private $con;

    protected function setUp(): void
    {
        $this->con = new mysqli("localhost", "mphil", "", "mvctut");
    }

    public function testConnection()
    {
        $result = $this->con->errno === 0;

        $this->assertTrue($result);
    }

    public function testIndexOutput() 
    {
        ob_start();
        require("index.php");
        $contents = ob_get_clean();
        $this->assertStringContainsString('<body>',$contents);
    }

    public function testRouteSuccessIntegration()
    {
        $_SERVER['REQUEST_URI']="/";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->addRoutes('/','UserController','home');
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('<div class="box">',$contents);        
    }
    
    public function testRouteUriExceptionIntegration()
    {
        $_SERVER['REQUEST_URI']="/asdf";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->addRoutes('/','UserController','home');
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('URI does not exist!',$contents);        
    }
    
    public function testRouteControllerExceptionIntegration()
    {
        $_SERVER['REQUEST_URI']="/";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->addRoutes('/','UserControllerBroken','home');
        $controller->home();
        $contents = ob_get_clean();
        $this->assertStringContainsString('Classname does not exist!',$contents);        
    }
    
    public function testRouteMethodExceptionIntegration()
    {
        $_SERVER['REQUEST_URI']="/";
        $routes = new Routes;
        $controller = new UserController;
        ob_start();
        $routes->addRoutes('/','UserController','Broken');
        $contents = ob_get_clean();
        $this->assertStringContainsString('Classname does not exist!',$contents);        
    }

    protected function tearDown(): void
    {
        $this->con->close();
    }
}
