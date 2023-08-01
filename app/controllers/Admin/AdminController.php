<?php 

namespace App\Controllers\Admin;

use App\Helpers\AuthHelper;
use App\Models\User;
use Core\Controller;

class AdminController extends Controller
{
    public function index() 
    {
        return $this->render('admin/index');
    }
}
