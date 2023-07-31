<?php

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

// try {
//     // $User = new Core\Model;
//     // var_dump($User);
// } catch (\mysqli_sql_exception $e) {
//     echo "Произошла ошибка подключения к базе данных: " . $e->getMessage(); 
//     // Можно выполнить дополнительные действия при обработке ошибки
// }