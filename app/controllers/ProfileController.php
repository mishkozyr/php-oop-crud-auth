<?php 

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use App\Helpers\AuthHelper;

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

        // check if the user is logged in using AuthHelper
        if (!AuthHelper::isLoggedIn()) {
            // redirect to the login page if the user is not logged in
            header("Location: /login");
            exit;
        }

        return $this->render('profile', ['userName' => $userName]);
    }
}
