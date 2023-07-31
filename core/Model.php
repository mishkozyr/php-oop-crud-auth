<?php

namespace Core;

class Model
{
    private static $link;

    public function __construct()
    {
        // Используем ленивую инициализацию соединения
        if (!self::$link) {
            self::$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            mysqli_set_charset(self::$link, 'utf8');
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function create($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        // Выполнить запрос на вставку данных
        mysqli_query(self::$link, $sql);

        // Вернуть идентификатор новой записи (если используется автоинкремент)
        return mysqli_insert_id(self::$link);
    }
}
