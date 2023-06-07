<?php

namespace App\core;

use App\model\Permission;

class PageController
{
    public static function render($page, $data)
    {
        $perms = new Permission();

        if (!$perms->getPermission($page)) {
            header('HTTP/1.1 302 Redirect');
            header('Location: /view/login');
            exit();
        }

        $include = $page . '.php';

        $dir = __DIR__ . '/../../resources/pages/';

        if (file_exists($dir . $include)) {
            include $dir . $include;
        } else {
            header('HTTP/1.1 302 Redirect');
            header('Location: /view/404');
            exit();
        }
    }
}

?>