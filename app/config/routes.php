<?php

use \Core\Route;

$getRoutes = [
    new Route('/', 'MainController', 'index'),
    new Route('/test', 'TestController', 'index'),
    new Route('/login', 'AuthController', 'indexLogin'),
    new Route('/register', 'AuthController', 'indexRegister'),
    new Route('/profile', 'ProfileController', 'index'),
    // Другие GET-маршруты
];

$postRoutes = [
    new Route('/login', 'AuthController', 'login'),
    new Route('/register', 'AuthController', 'register'),
    // Другие POST-маршруты
];