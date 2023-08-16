<?php

namespace controllers;

use Exception;

class Router
{
    private $controller;
    private $Auth;

    public function __construct($controller,$Auth){

        $this->controller = $controller;
        $this->Auth = $Auth;

    }

    public function start(){
        try {

            $urlPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");


            switch ($urlPath){
                case "" :
                    $this->controller->index();
                    break;
                case "hike":
                    $this->controller->hike();
                    break;
                case "logout":
                    $this->Auth->logout();
                    break;
                case "register":
                    $this->Auth->register();
                    break;
                case "login":
                    $this->Auth->login();
                    break;
                case "error":
                    $this->controller->errorPage("error","500");
                    break;
                case "profile":
                    $this->Auth->profile();
                    break;
                default:
                    $this->controller->errorPage("Page Introuvable","404");
                    break;
            }

        }catch (Exception $e){

            $this->controller->errorPage($e->getMessage(),"500");
        }
    }


}