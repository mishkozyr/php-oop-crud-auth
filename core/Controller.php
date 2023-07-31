<?php

namespace Core;

class Controller
{
    protected function render($view = null, $data = []) {
        $view = new View($view, $data);
        return $view->render();
    }
}
