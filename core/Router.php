<?php

namespace Core;

class Router 
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function handleRequest($method, $currentPath)
    {
        if (isset($this->routes[$method])) {
            $routes = $this->routes[$method];
        
            foreach ($routes as $route) {
                $pattern = preg_replace('/\/:([^\/]+)/', '/([^\/]+)', $route->path);
                $pattern = '#^' . $pattern . '$#';
    
                if (preg_match($pattern, $currentPath, $matches)) {
                    array_shift($matches); // Удаляем первый элемент, так как он содержит весь совпавший путь
    
                    $controllerName = 'App\Controllers\\' . $route->controller;
                    $controller = new $controllerName();
                    $method = $route->method;
                    return $controller->$method($matches);
                }
            }
                
        }

        return '404';
    }
}