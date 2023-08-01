<?php 

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\User;
use Core\Controller;

class ProfileController extends Controller
{
    public function index($routeParameters = []) 
    {
        // since /profile/:userId is the first parameter of the route
        $userId = $routeParameters[0];

        // search for a user by id in the database
        $user = new User;
        $user = $user->find('test_users', 'id', $userId);

        $userName = $user['name'];

        return $this->render('profile', ['userName' => $userName]);
    }
}
