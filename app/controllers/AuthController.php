<?php 

namespace App\Controllers;

use App\Helpers\AuthHelper;
use App\Models\User;
use Core\Controller;

session_start();

class AuthController extends Controller
{
    public function indexLogin() 
    {
        // check if the user is logged in using AuthHelper
        if (AuthHelper::isLoggedIn()) {
            $userId = $_SESSION['user_id'];
            // redirect to the profile page if the user is not logged in
            header("Location: /profile/$userId");
            exit;
        }

        return $this->render('login');
    }

    public function indexRegister() 
    {
        // check if the user is logged in using AuthHelper
        if (AuthHelper::isLoggedIn()) {
            $userId = $_SESSION['user_id'];
            // redirect to the profile page if the user is not logged in
            header("Location: /profile/$userId");
            exit;
        }

        return $this->render('register');
    }

    public function register()
    {
        // getting data from a POST request
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // data validation
        $errors = [];

        // name check: must not be empty
        if (empty($name)) {
            $errors["name"] = "Введите имя";
        }

        // email verification: must be a valid email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Некорректный email";
        }

        // password verification: must be non-empty and match the password confirmation
        if (empty($password)) {
            $errors["password"] = "Введите пароль";
        } elseif ($password !== $confirm_password) {
            $errors["confirm_password"] = "Пароли не совпадают";
        }

        // if there are validation errors, we return a representation with errors
        if (!empty($errors)) {
            return $this->render('register', ['errors' => $errors, 'post' => $_POST, 'success' => '0']);
        }

        // hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // creating a new User object with user data
        $user = new User;

        $user->create('test_users', [
            'name' => $name,
            'email' => $email,
            'password_hash' => $hashed_password,
            'role_id' => 1,
        ]);

        header("Location: /login");
        exit;
    }

    public function login()
    {
        // getting data from a POST request
        $email = $_POST["email"];
        $password = $_POST["password"];

        // data validation
        $errors = [];

        // email verification: must be a valid email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Некорректный email";
        }

        // password verification: must not be empty
        if (empty($password)) {
            $errors["password"] = "Введите пароль";
        }

        // if there are validation errors, we return a representation with errors
        if (!empty($errors)) {
            return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
        }

        // search for a user by email in the database
        $user = new User;
        $user = $user->find('test_users', 'email', $email);

        // checking that a user with such an email exists
        if (!$user) {
            $errors["email"] = "Пользователь с таким email не найден";
            return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
        }

        // verifying the password is correct
        if (!password_verify($password, $user['password_hash'])) {
            $errors["password"] = "Неверный пароль";
            return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
        }

        // user authentication succeeded, set a session variable to indicate the user is logged in
        $userId = $user['id'];
        $_SESSION['user_id'] = $userId;

        header("Location: /profile/$userId");
        exit;
    }

    public function logout()
    {
        // Clear the session and destroy it
        session_unset();
        session_destroy();

        // Redirect the user to the main page after logging out
        header("Location: /");
        exit;
    }

    
}
