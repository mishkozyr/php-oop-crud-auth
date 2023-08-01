<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function __invoke()
    {
        return isset($_SESSION['user_id']);
    }
}
