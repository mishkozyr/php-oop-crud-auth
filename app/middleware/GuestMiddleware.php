<?php

namespace App\Middleware;

class GuestMiddleware
{
    public function __invoke()
    {
        return !isset($_SESSION['user_id']);
    }
}
