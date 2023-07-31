<?php 

namespace App\Controllers;

use Core\Controller;

class MainController extends Controller
{
    public function index() 
    {
        return $this->render('main', ['title' => 'My Page Title']);
    }
}
