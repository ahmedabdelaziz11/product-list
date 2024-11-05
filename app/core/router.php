<?php
namespace App\core;

class router 
{
    private $routes = [];

    public function get($uri, $controller)
    {
        $this->addRoute('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->addRoute('POST', $uri, $controller);
    }

    private function addRoute($method, $uri, $controller)
    {
        $this->routes[] = ['method' => $method, 'uri' => trim($uri, '/'), 'controller' => $controller];
    }

    public function dispatch()
    {
        $requestUri = trim($_SERVER['QUERY_STRING'], '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                return $this->callController($route['controller']);
            }
        }

        http_response_code(404);
        echo "<h1> 404 - Not Found </h1>";
    }

    private function callController($controller)
    {
        list($class, $method) = explode('@', $controller);
        $class = "App\\controllers\\$class";
        
        if (class_exists($class)) {
            $controllerInstance = new $class();
            if (method_exists($controllerInstance, $method)) {
                return $controllerInstance->$method();
            }
        }

        http_response_code(500);
        echo "<h1> 500 - Controller not found </h1>";
    }
};