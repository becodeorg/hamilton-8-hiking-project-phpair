<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use controllers\PageController;


try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

    switch ($url_path) {
        case "":
        case "/index.php":
            $pageController = new PageController();
            $pageController->index();
            break;
        case "hike":
            $pageController = new PageController();
            $pageController->hike();
            break;
        case "login":
            
            break;
        case "logout":
            
            break;
        case "register":
            
            break;
        default:
           
    }
} catch (Exception $e) {
    //$pageController = new PageController();
    //$pageController->page_500($e->getMessage()); need to change name and create the pages first
}
