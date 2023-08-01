<?php

namespace App\Middleware;

class AdminMiddleware
{
    public function __invoke()
    {
        return isset($_SESSION['admin']) && $_SESSION['admin'];
    }
}
