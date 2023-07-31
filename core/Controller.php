<?php

namespace Core;

class Controller
{
    protected function render($view = null, $data = [], $layout = 'layout') {
        $view = new View($layout, $view, $data);

        return $view->render();
    }
}
