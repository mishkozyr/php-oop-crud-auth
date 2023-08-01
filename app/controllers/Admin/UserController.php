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

    public function create()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Getting data from a POST request
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role_id = $_POST["role_id"];

            // Validate the input data
            $errors = [];

            if (empty($name)) {
                $errors["name"] = "Name is required";
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email";
            }

            if (empty($password)) {
                $errors["password"] = "Password is required";
            }

            if (!is_numeric($role_id)) {
                $errors["role_id"] = "Invalid role ID";
            }

            if (!empty($errors)) {
                // Render the form again with validation errors
                return $this->render('admin/users/create', [
                    'title' => 'Create User - Admin panel',
                    'errors' => $errors,
                    'name' => $name,
                    'email' => $email,
                    'role_id' => $role_id,
                ]);
            }

            // Hash the password before saving to the database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare the data to insert into the database
            $dataToInsert = [
                'name' => $name,
                'email' => $email,
                'password_hash' => $hashedPassword,
                'role_id' => $role_id,
            ];

            // Insert the data into the database
            (new User)->create('test_users', $dataToInsert);

            // Redirect to the users list page after successful creation
            header("Location: /admin/users");
            exit;
        }

        // Render the form for creating a new user
        return $this->render('admin/users/create', [
            'title' => 'Create User - Admin panel',
        ]);
    }
}
