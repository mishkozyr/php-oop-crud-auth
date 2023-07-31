<?php

namespace Core;

class Router 
{
    public function handleRequest($routes, $currentPath)
    {
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

        // Если ни один маршрут не соответствует текущему пути, возвращаем '404'
        return '404';
    }
}
