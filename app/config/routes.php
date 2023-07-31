<?php

use \Core\Route;

return [
    new Route('/test', 'TestController', 'index'),
    new Route('/test/:id', 'TestController', 'show'),
    new Route('/user/:username/post/:postId', 'PostController', 'show'),
];
