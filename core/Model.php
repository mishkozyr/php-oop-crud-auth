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

    public function find($table, $column, $value)
    {
        $column = mysqli_real_escape_string(self::$link, $column);
        $value = mysqli_real_escape_string(self::$link, $value);

        $sql = "SELECT * FROM $table WHERE $column = '$value'";
        $result = mysqli_query(self::$link, $sql);

        if (!$result || mysqli_num_rows($result) === 0) {
            return null; // Record not found
        }

        // Fetch the record data from the result set
        $record = mysqli_fetch_assoc($result);

        return $record;
    }

    public function all($table)
    {
        $table = mysqli_real_escape_string(self::$link, $table);

        $sql = "SELECT * FROM $table";
        $result = mysqli_query(self::$link, $sql);

        if (!$result || mysqli_num_rows($result) === 0) {
            return []; // Return an empty array when no records found
        }

        $records = [];
        while ($record = mysqli_fetch_assoc($result)) {
            $records[] = $record;
        }

        return $records;
    }

    public function update($table, $data, $primaryKey, $id)
    {
        $sets = [];
        foreach ($data as $column => $value) {
            $column = mysqli_real_escape_string(self::$link, $column);
            $value = mysqli_real_escape_string(self::$link, $value);
            $sets[] = "$column = '$value'";
        }

        $primaryKey = mysqli_real_escape_string(self::$link, $primaryKey);
        $id = mysqli_real_escape_string(self::$link, $id);

        $sets = implode(', ', $sets);
        $sql = "UPDATE $table SET $sets WHERE $primaryKey = '$id'";

        return mysqli_query(self::$link, $sql);
    }

    public function delete($table, $primaryKey, $id)
    {
        $primaryKey = mysqli_real_escape_string(self::$link, $primaryKey);
        $id = mysqli_real_escape_string(self::$link, $id);

        $sql = "DELETE FROM $table WHERE $primaryKey = '$id'";

        return mysqli_query(self::$link, $sql);
    }
}
