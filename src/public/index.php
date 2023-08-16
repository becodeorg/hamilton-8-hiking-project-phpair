<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use controllers\AuthController;
use controllers\PageController;
use controllers\Router;


$controller = new PageController();
$AuthController = new AuthController();
$router = new Router($controller,$AuthController);
$router->start();
