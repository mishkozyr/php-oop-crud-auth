<?php

namespace Core;

class Controller
{
    protected function render($view = null, $data = [], $layout = DELAUFT_LAYOUT) {
        $view = new View($layout, $view, $data);

        return $view->render();
    }
}
