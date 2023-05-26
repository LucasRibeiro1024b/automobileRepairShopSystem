<?php

namespace App\core;

class PageController
{
    public static function render($page, $data)
    {
        include __DIR__ . '/../../resources/pages/head.php';

        $include = $page . '.php';

        $dir = __DIR__ . '/../../resources/pages/';

        if (file_exists($dir . $include)) {
            include $dir . $include;
        } else {
            header('HTTP/1.1 302 Redirect');
            header('Location: /view/404');
            exit();
        }
        include __DIR__ . '/../../resources/pages/footer.php';
    }
}

?>