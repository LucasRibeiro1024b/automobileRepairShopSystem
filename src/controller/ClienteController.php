<?php

namespace App\controller;

use App\model\Cliente;
use App\core\PageController;

class ClienteController
{
    public static function index()
    {
        PageController::render('cliente', null);
    }
}

?>