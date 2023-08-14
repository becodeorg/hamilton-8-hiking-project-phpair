<?php
declare(strict_types=1);

use Controllers\AuthController;
use controllers\Router;

require 'vendor/autoload.php';

$AuthController = new AuthController();

//$router = new Router(null,$AuthController);
//
//$router->start();

try {
    $AuthController->login();
} catch (Exception $e) {
    echo $e;
}

