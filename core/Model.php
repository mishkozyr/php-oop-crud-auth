<?php

namespace Core;

class Model
{
    private static $link;

    public function __construct()
    {
        // Используем ленивую инициализацию соединения
        if (!self::$link) {
            $this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            mysqli_set_charset($this->link, 'utf8');
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function __destruct()
    {
        // Автоматическое закрытие соединения при уничтожении объекта
        mysqli_close($this->link);
    }
}
