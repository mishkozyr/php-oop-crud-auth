<?php 

namespace App\Controllers\Admin;

use App\Models\User;
use Core\Controller;

class UserController extends Controller
{
    public function show() 
    {
        $users = (new User)->all('test_users');

        return $this->render('admin/users/show', [
            'title' => 'Users - Admin panel',
            'users' => $users,
        ]);
    }

    public function edit($routeParameters = []) 
    {
        // since /profile/:userId is the first parameter of the route
        $userId = $routeParameters[0];

        // search for a user by id in the database
        $user = (new User)->find('test_users', 'id', $userId);

        return $this->render("admin/users/edit", [
            'title' => "Edit user $userId - Admin panel",
            'user' => $user,
        ]);
    }

    public function update() 
    {
        // getting data from a POST request
        $userId = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $role_id = $_POST["role_id"];

        $dataToUpdate = [
            'name' => $name,
            'email' => $email,
            'role_id' => $role_id, 
        ];

        (new User)->update('test_users', $dataToUpdate, 'id', $userId);

        header("Location: /admin/users");
        exit;
    }

    public function delete() 
    {
        // getting data from a POST request
        $userId = $_POST["id"];
        
        (new User)->delete('test_users', 'id', $userId);

        header("Location: /admin/users");
        exit;
    }
}
