<?php

namespace controllers;

use models\Database;
use Exception;

class PageController
{
    private $db;

    public function __construct(){
        $this->db = new Database();
        session_start();
    }

    public function index(){

        try {

            $hikes = $this->db->fetchAll("SELECT * FROM Hikes LIMIT 20");

            include 'views/inc/header.view.php';
            include 'views/index.view.php';
            include 'views/inc/footer.view.php';

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function hike(){

        try {

            $hike = $this->db->prepare("SELECT * FROM Hikes WHERE id = ?",[$_GET['id']]);
            //includes
            include 'views/inc/header.view.php';
            include 'views/hike.view.php';
            include 'views/inc/footer.view.php';

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }


    public function errorPage($e, $errorCode){

        include 'views/layout/header.view.php';
        include 'views/layout/errorPage.view.php';
        include 'views/layout/footer.view.php';


    }

}
