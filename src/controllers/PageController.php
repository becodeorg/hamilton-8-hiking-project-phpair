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
                SELECT 
                    Hikes.id,
                    Hikes.name, 
                    Hikes.distance, 
                    Hikes.duration,
                    Hikes.elevation_gain,
                    Hikes.created_at,
                    Hikes.updated_at,
                    Users.nickname,
                    Hikes.creator_id AS creatorId
                
                FROM Hikes 
                JOIN Users ON Hikes.creator_id = Users.id
                JOIN TagsHikes ON Hikes.id = TagsHikes.id_Hike
                JOIN Tags ON Tags.id = TagsHikes.id_Tag
                GROUP BY 
                    Hikes.name, 
                    Hikes.distance, 
                    Hikes.duration,
                    Hikes.elevation_gain,
                    Hikes.id, 
                    Hikes.created_at,
                    Hikes.updated_at,
                    Users.nickname,
                    creatorId
                    
                LIMIT 20
               ");
                $tagsIndex = $this->db->fetchAll("
                select 
                    Tags.name,
                    id_Hike as Hike,
                    H.id
                from Tags
                join TagsHikes TH on Tags.id = TH.id_Tag
                join Hikes H on H.id = TH.id_Hike
                WHERE TH.id_Hike = H.id
                GROUP BY 
                    Tags.name,
                    Hike,
                    H.id
                ");
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
