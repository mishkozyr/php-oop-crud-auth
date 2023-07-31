<?php

namespace Core;
	
class View
{
    private $layout = 'test';
    private $view;
    private $data;
    
    public function __construct($view, $data)
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
        return require $this->getViewFilePath();
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
