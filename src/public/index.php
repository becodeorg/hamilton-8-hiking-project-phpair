<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use controllers\PageController;
use controllers\Router;
use controllers\AuthController;

$auth = new AuthController();
$pageController = new PageController();
$router = new Router($pageController, $auth); 
$router->start();
