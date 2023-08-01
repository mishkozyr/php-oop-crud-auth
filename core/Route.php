<?php

namespace Core;

class Route
{
    private $path;
    private $controller;
    private $method;
    private $middleware = [];
    
    public function __construct($path, $controller, $method, $middleware = [])
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
        $this->addMiddleware($middleware);
    }
    
    public function __get($property)
    {
        return $this->$property;
    }

    public function addMiddleware($middleware)
    {
        if (is_array($middleware)) {
            $this->middleware = array_merge($this->middleware, $middleware);
        }
    }

    // public function match($url)
    // {
    //     // check if the URL matches the route pattern
    //     // ...

    //     // call the middleware before executing the controller method
    //     foreach ($this->middleware as $middleware) {
    //         $middlewareInstance = new $middleware();
    //         if (!$middlewareInstance->handle()) {
    //             // middleware returned false, abort further execution
    //             return false;
    //         }
    //     }

    //     // execute the controller method
    //     $controllerInstance = new $this->controller();
    //     $method = $this->method;
    //     $controllerInstance->$method();
    // }
}
