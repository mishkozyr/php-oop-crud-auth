<?php

namespace Core;

class View
{
    private $view;
    private $data;
    private $layout; // name of the layout file

    public function __construct($layout, $view, $data = [])
    {
        $this->layout = $layout;
        $this->view = $view;
        $this->data = $data;
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function render()
    {
        // import the data into the local scope
        extract($this->data);
    
        // start output buffering to capture the view content
        ob_start();
        require $this->getViewFilePath();
        $content = ob_get_clean();
    
        // load the layout file and insert the content into the $slot variable
        $layoutFile = $this->getLayoutFilePath();
        if ($layoutFile) {
            ob_start();
            require $layoutFile;
            return ob_get_clean();
        } else {
            // handle the case when the layout file is not found
            // if the layout is not specified, return the content directly
            return $content;
        }
    }    

    private function getViewFilePath()
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $this->view . '.php';
        if (file_exists($file)) {
            return $file;
        }
        return null;
    }

    private function getLayoutFilePath()
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $this->layout . '.php';
        if (file_exists($file)) {
            return $file;
        }
        return null; // This might cause the "ValueError: Path cannot be empty" error
    }
    
}
