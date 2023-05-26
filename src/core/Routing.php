<?php

namespace App\core;

use App\core\PageController;
use App\controller\LoginController;

class Routing
{
    private $url;
    private $sections;
    private $type;
    private $page;
    private $data;

    public function __construct()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $this->url = "https://";
        else
            $this->url = "http://";

        $this->url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $urlArray  = parse_url($this->url);

        $this->sections = explode('/', $urlArray['path']);
        $this->page     = $this->sections[2] ?? null;
        $this->type     = $this->sections[1] ?? null;

        // if (!isset($_SESSION['user_logged_in']) && !$_SESSION['user_logged_in'] === true) {
        //     $this->type = 'login';
        // }
    }

    public function render()
    {

        // if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
        //     header('Location: /view/login');
        //     return 0;
        // }

        switch ($this->type) {
            case '':
                if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
                    header('HTTP/1.1 302 Redirect');
                    header('Location: /view/dashboard');
                }
                PageController::render('login', null);
                break;

            case 'view':
                if ($this->page == 404 || $this->page == '') {
                    PageController::render('404', null);
                    exit();
                }

                $controllerName = 'App\Controller\\' . $this->page . 'Controller';

                if (class_exists($controllerName)) {
                    $instance = new $controllerName();
                    $instance->index();
                } else {
                    PageController::render($this->page, null);
                }

                break;

            case 'api':
                break;

            default:
                header('Location: /view/404');
                PageController::render('404', null);
                break;
        }
    }
}

?>