<?php

namespace App\Helpers;

class AuthHelper
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}
