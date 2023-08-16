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
            
            $tags = $this->db->fetchAll('SELECT * FROM Tags');
            

            if(isset($_POST['hikesPerTag'])){
                $tag=$_POST['hikesPerTag'];
                $hikes = $this->db->prepareAll("
                SELECT *, Hikes.name
                FROM Hikes 
                JOIN Users ON Hikes.creator_id = Users.id
                    
                JOIN TagsHikes ON Hikes.id = TagsHikes.id_Hike
                JOIN Tags ON Tags.id = TagsHikes.id_Tag
                WHERE Tags.id = ?", [$tag]);
            }
            else{
                $hikes = $this->db->fetchAll("
                SELECT * 
                FROM Hikes 
                JOIN Users ON Hikes.creator_id = Users.id
                LIMIT 20");
            }



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

        include 'views/inc/header.view.php';
        include 'views/inc/errorPage.view.php';
        include 'views/inc/footer.view.php';


    }

}
