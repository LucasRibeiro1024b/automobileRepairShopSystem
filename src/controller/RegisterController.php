<?php

namespace App\controller;

use App\model\User;
use App\controller\LoginController;
use App\core\PageController;

class RegisterController
{
    public static function index()
    {

        PageController::render('register', null);
        exit();
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            if (empty($_POST)) {
                throw new \Exception('');
            }

            if (!$email) {
                throw new \Exception('Invalid email');
            }

            $password = filter_input(INPUT_POST, 'password');
            if (!$password || mb_strlen($password) < 8) {
                throw new \Exception('Password must contain 8+ characters');
            }

            $passwordHash = password_hash(
                $password,
                PASSWORD_DEFAULT,
                ['cost' => 12]
            );

            $person                = new User();
            $person->email         = $email;
            $person->password_hash = $passwordHash;
            $return                = $person->save();

            if ($return) {
                header('HTTP/1.1 302 Redirect');
                // header('Location: /login');
                LoginController::loginUp($email, $password);
                exit();
            } else {
                $alert = "An error ocorred! If it keep happening call the support.";
            }

        } catch (\Exception $e) {
            $alert = $e->getMessage();
        }
    }
}