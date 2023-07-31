<?php

namespace Core;
	
class View
{
    private $view;
    private $data;
    
    public function __construct($view = null, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }
    
    public function __get($property)
    {
        return $this->$property;
    }

    public function render()
    {
        // Импортируем данные в локальную область видимости
        extract($this->data);

        // Подключаем файл представления
        ob_start();
        require $this->getViewFilePath();
        return ob_get_clean();
    }

    private function getViewFilePath()
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $this->view . '.php';

        if (file_exists($file)) {
            return $file;
        }

        return null;
    }
}
