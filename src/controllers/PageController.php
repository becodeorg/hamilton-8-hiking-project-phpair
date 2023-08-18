<?php

namespace controllers;

use Exception;
use models\Hikes;

class PageController
{
    private $hike;
    public function __construct(){
        session_start();
        $this->hike = (new Hikes());
    }

    public function index(){

        try {
            $tags=$this->hike->selectAllTags();
            

            if(isset($_POST['hikesPerTag'])){
                $tag=$_POST['hikesPerTag'];
                $hikes = $this->hike->getHikesByTag($tag);
            }
            else{
                $hikes = $this->hike->getListHikes();
                $tagsIndex=$this->hike->getListTags();
            }
            if(isset($_GET['hikeid'])){
                $this->hike->addToFav($_GET['hikeid'], $_SESSION['user']['id']);
            }
            
            $favHike=$this->hike->getFavHikes($_SESSION['user']['id']);
            

            include 'views/inc/header.view.php';
            include 'views/index.view.php';
            include 'views/inc/footer.view.php';

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function hike(){

        try {

            $hike = $this->hike->getHikesById([$_GET['id']]);
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

    public function editHike(){
        try {
            $hike = $this->hike->getHikesById([$_GET['id']]);
            $updated_at = date('Y-m-d');
            include 'views/inc/header.view.php';
            include 'views/editHike.view.php';
            include 'views/inc/footer.view.php';

            if(!empty($_POST) && $hike['creator_id'] == $_SESSION['user']['id']
            ) {
                var_dump($_POST);
                
                $this->hike->editH($_POST['hikeName'],$_POST['distance'],$_POST['duration'],$_POST['elevation_gain'],$_POST['description'], $updated_at ,$hike['id']);
            }else {
                throw new Exception("un ou plusieurs champs sont vides", 500);
            }
            if($hike['creator_id'] == $_SESSION['user']['id'] && $_POST['action'] == 'Delete'){
                $this->hike->deleteH($hike['id']);
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}
