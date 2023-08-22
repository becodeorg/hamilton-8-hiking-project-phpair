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
            $tagsIndex = $this->hike->getListTags();

            if(isset($_POST['hikesPerTag'])){
                $tag=$_POST['hikesPerTag'];
                if($_POST['hikesPerTag'] != "all"){
                    $hikes = $this->hike->getHikesByTag($tag);
                }else{
                    $hikes = $this->hike->getListHikes();
                }

            }
            else{
                $hikes = $this->hike->getListHikes();
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

            $tagsIndex = $this->hike->getListTags();
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


    public function createTag(){

        if(isset($_POST['tag'])){
            $this->hike->addTag($_POST['tag']);
            header("Location: /profile");
        }

        include 'views/inc/header.view.php';
        include 'views/createTag.view.php';
        include 'views/inc/footer.view.php';

    }


    public function editHike(){
        try {

            if(isset($_GET['m'])){
                $errormessage = htmlspecialchars($_GET['m']);
            }

            $hike = $this->hike->getHikesById([$_GET['id']]);
            $tags= $this->hike->selectAllTags();
            $id= $_GET['id'];

            $tagsFromHike=$this->hike->getTagByHike($id);


            $updated_at = date('Y-m-d');

            include 'views/inc/header.view.php';
            include 'views/editHike.view.php';
            include 'views/inc/footer.view.php';

            if($hike['creator_id'] == $_SESSION['user']['id'])
            {
                if($_POST['action']=='Update' && !empty($_POST) ){
                    $this->hike->editH($_POST['hikeName'],$_POST['distance'],$_POST['duration'],$_POST['elevation_gain'],$_POST['description'], $updated_at ,$id, $_POST['tagInput']);
                    header("Location: /profile");
                    exit();
                }
                if($_POST['action'] == 'Delete'){
                    $this->hike->deleteH($id);
                    header("Location: /profile");
                    exit();
                }
                
            }
            if(empty($_GET['id'])){
                $created=date('Y-m-d');
                $userid=$_SESSION['user']['id'];
                $this->hike->addHike($_POST['hikeName'],$_POST['distance'],$_POST['duration'],$_POST['elevation_gain'],$_POST['description'],$created,$created,$userid);
            }
                //throw new Exception("un ou plusieurs champs sont vides", 500);
                
            
        }catch (Exception $e){
            header('Location: /editHike?m="un%20ou%20plusieurs%20champs%20sont%20vides"');
        }
    }

}
