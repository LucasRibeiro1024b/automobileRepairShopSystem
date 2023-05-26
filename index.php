<?php
session_start([
    'cache_limiter' => 'private',
]);

require_once "vendor/autoload.php";

use App\core\Routing;

$router = new Routing();
$router->render();