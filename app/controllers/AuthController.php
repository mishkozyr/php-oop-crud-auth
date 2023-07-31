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

        // Валидация данных (ваш код валидации)

        // Проверка, что пароли совпадают
        if ($password !== $confirm_password) {
            // Вывод ошибки или редирект на страницу с ошибкой
            // ...

            // Возвращаем представление с данными формы
            return $this->render('register', ['post' => $_POST]);
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

        return $this->render('register', ['post' => $_POST]);
    }
}
