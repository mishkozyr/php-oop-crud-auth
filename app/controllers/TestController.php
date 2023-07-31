<?php 

namespace App\Controllers;

use Core\Controller;

class TestController extends Controller
{
    public function index() 
    {
        return $this->render('test', ['name' => 'John']);
        // return 'aaa';
    }
}
