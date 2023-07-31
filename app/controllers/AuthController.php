<?php 

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class AuthController extends Controller
{
    public function indexLogin() 
    {
        return $this->render('login');
    }

    public function indexRegister() 
    {
        return $this->render('register');
    }

    public function register()
    {
        // Получаем данные из POST-запроса
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Валидация данных
        $errors = [];

        // Проверка имени: должно быть не пустым
        if (empty($name)) {
            $errors["name"] = "Введите имя";
        }

        // Проверка email: должен быть корректным email-адресом
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Некорректный email";
        }

        // Проверка пароля: должен быть не пустым и совпадать с подтверждением пароля
        if (empty($password)) {
            $errors["password"] = "Введите пароль";
        } elseif ($password !== $confirm_password) {
            $errors["confirm_password"] = "Пароли не совпадают";
        }

        // Если есть ошибки валидации, возвращаем представление с ошибками
        if (!empty($errors)) {
            return $this->render('register', ['errors' => $errors, 'post' => $_POST, 'success' => '0']);
        }

        // Хешируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Создаем новый объект User с данными пользователя
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
    // Получаем данные из POST-запроса
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Валидация данных
    $errors = [];

    // Проверка email: должен быть корректным email-адресом
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Некорректный email";
    }

    // Проверка пароля: должен быть не пустым
    if (empty($password)) {
        $errors["password"] = "Введите пароль";
    }

    // Если есть ошибки валидации, возвращаем представление с ошибками
    if (!empty($errors)) {
        return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
    }

    // Поиск пользователя по email в базе данных (ваш код поиска пользователя)
    $user = new User;
    $user = $user->find('test_users', 'email', $email);

    // Проверка, что пользователь с таким email существует
    if (!$user) {
        $errors["email"] = "Пользователь с таким email не найден";
        return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
    }

    // Проверка правильности пароля
    if (!password_verify($password, $user['password_hash'])) {
        $errors["password"] = "Неверный пароль";
        return $this->render('login', ['errors' => $errors, 'post' => $_POST]);
    }

    header("Location: /");
    exit;
}

    
}
