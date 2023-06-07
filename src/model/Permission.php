<?php

namespace App\model;

class Permission extends db
{

    private $permissions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTable('permission');

        $this->getPermissionByUser($_SESSION['user_email']);
    }

    private function getPermissionByUser($userEmail)
    {
        $columns = 'permission.id, pages.page_name';
        $joins   = 'LEFT JOIN user ON user.id = permission.user_id
                    LEFT JOIN pages ON permission.page_id = pages.id';

        $result = $this->select($columns, 'user.email = :email', [':email' => $userEmail], $joins);
        if (!empty($result)) {
            $this->permissions = $result;
        } else {
            $this->permissions = false;
        }
    }

    public function getPermission($pageName)
    {
        $exceptions = ['login', 'logout'];

        if (in_array($pageName, $exceptions)) {
            return true;
        }

        $value = false;
        if ($this->permissions !== false) {
            $permittedPages = array_column($this->permissions, 'page_name');
            $value          = array_search($pageName, $permittedPages);
        }

        if ($value !== false) {
            return true;
        }

        return false;
    }

    public function getArray()
    {
        return $this->permissions;
    }
}