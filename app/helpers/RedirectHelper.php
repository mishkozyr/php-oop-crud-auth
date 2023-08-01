<?php

namespace App\Helpers;

class RedirectHelper
{
    public static function redirectBack()
    {
        $previousPage = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $previousPage");
        exit;
    }
}
