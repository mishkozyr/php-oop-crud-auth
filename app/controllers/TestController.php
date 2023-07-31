<?php 

namespace App\Controllers;

use Core\Controller;
use Core\View;

class TestController extends Controller
{
    public function index() 
    {
        return $this->render('test');
        // return 'aaa';
    }
}
