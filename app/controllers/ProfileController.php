<?php 

namespace App\Controllers;

use Core\Controller;

class ProfileController extends Controller
{
    public function index() 
    {
        return $this->render('profile');
    }
}
