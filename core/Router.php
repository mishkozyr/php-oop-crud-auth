<?php

namespace Core;
use App\Helpers\RedirectHelper;

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
                    array_shift($matches); // delete the first element, since it contains the entire matched path

                    // check if the route has middleware defined
                    if ($route->middleware && is_array($route->middleware)) {
                        // check each middleware
                        foreach ($route->middleware as $middleware) {
                            if (!(new $middleware())()) {
                                // middleware failed, return redirect back
                                return RedirectHelper::redirectBack();
                            }
                        }
                    }

                    $controllerName = 'App\Controllers\\' . $route->controller;
                    $controller = new $controllerName();
                    $method = $route->method;
                    return $controller->$method($matches);
                }
            }
                
        }

        $view = new View(DELAUFT_LAYOUT,'404');
        return $view->render();
    }
}
