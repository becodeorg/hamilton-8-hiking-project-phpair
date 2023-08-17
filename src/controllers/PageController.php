<?php

namespace controllers;

use models\Database;
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

}
