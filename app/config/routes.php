<?php

use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use \Core\Route;

// GET routes
$getRoutes = [
    new Route('/', 'MainController', 'index'),
    new Route('/test', 'TestController', 'index'),

    new Route('/register', 'AuthController', 'indexRegister', [GuestMiddleware::class]),
    new Route('/login', 'AuthController', 'indexLogin', [GuestMiddleware::class]),
    new Route('/logout', 'AuthController', 'logout'),

    new Route('/profile/:userId', 'ProfileController', 'index', [AuthMiddleware::class]),

    new Route('/admin', 'Admin\AdminController', 'index', [
        AuthMiddleware::class,
        AdminMiddleware::class,
    ]),

    new Route('/admin/users', 'Admin\UserController', 'show', [
        AuthMiddleware::class,
        AdminMiddleware::class,
    ]),
    new Route('/admin/users/edit/:userId', 'Admin\UserController', 'edit', [
        AuthMiddleware::class,
        AdminMiddleware::class,
    ]),
];

// POST routes
$postRoutes = [
    new Route('/login', 'AuthController', 'login'),
    new Route('/register', 'AuthController', 'register'),
];
