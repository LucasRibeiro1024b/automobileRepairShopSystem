<?php

namespace App\model;

class User extends db
{
    public $id;
    public $name;
    public $email;
    public $password_hash;
    public $first_login;

    public function __construct()
    {
        parent::__construct();
        $this->setTable('user');
    }

    public function save()
    {
        return $this->insert(get_object_vars($this));
    }

    public static function findByEmail($email)
    {
        $user = new self();

        $result = $user->select('*', 'email = :email', [':email' => $email]);
        if (!empty($result)) {
            foreach ($result[0] as $key => $value) {
                $user->{$key} = $value;
            }
            return $user;
        } else {
            return false;
        }
    }
}

?>