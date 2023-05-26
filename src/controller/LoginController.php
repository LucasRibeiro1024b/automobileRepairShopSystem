<?php

namespace App\controller;

use App\model\User;
use App\core\PageController;

class LoginController
{
    public static function index()
    {
        pre($_SESSION);

        try {
            $email    = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

            if (empty($email) || empty($password)) {
                throw new \Exception("Invalid Input");
            }

            $user = User::findByEmail($email);

            if (password_verify($password, $user->password_hash) === false) {
                throw new \Exception("Invalid Password");
            }

            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_email']     = $email;

            header('HTTP/1.1 302 Redirect');
            header('Location: /view/dashboard');
        } catch (\Exception $e) {
            $_SESSION['login_error'] = $e->getMessage();

            header('HTTP/1.1 302 Redirect');
            PageController::render('login', null);
        }
    }
}