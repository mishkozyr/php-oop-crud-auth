<?php

// start the session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/config/connection.php';

spl_autoload_register(function($class) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    $ds = DIRECTORY_SEPARATOR;
    
    $filename = $root . $ds . str_replace('\\', $ds, $class) . '.php';
    require($filename);
});

$routes = require $_SERVER['DOCUMENT_ROOT'] . '/app/config/routes.php';

$router = new Core\Router([
    'GET' => $getRoutes,
    'POST' => $postRoutes,
]);

$response = $router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
if (is_string($response)) { echo $response; }
