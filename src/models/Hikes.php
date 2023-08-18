<?php
declare(strict_types=1);

namespace models;

use PDO;
class Hikes extends Database{
    public function selectAllTags(){
        return $this->fetchAll("SELECT * FROM Tags");
    }
    
    public function getHikesByTag(string $tag){
        return $this->prepareAll("
                SELECT *,Hikes.id AS idhike, Hikes.name, Tags.id AS tagsId, TagsHikes.id_tag AS tagshikesid
                FROM Hikes 
                JOIN Users ON Hikes.creator_id = Users.id
                    
                JOIN TagsHikes ON Hikes.id = TagsHikes.id_Hike
                JOIN Tags ON Tags.id = TagsHikes.id_Tag
                WHERE Tags.id = ?", [$tag]);
    }
    public function getListHikes(){
        return $this->fetchAll("
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
    }
    public function getListTags(){
        return $this->fetchAll("
            select 
                Tags.name,
                id_Hike as Hike,
                H.id
            from Tags
            join TagsHikes TH on Tags.id = TH.id_Tag
            join Hikes H on H.id = TH.id_Hike

            GROUP BY 
                Tags.name,
                Hike,
                H.id
        ");
    }
    public function getHikesById($var){
        return $this->prepare("SELECT * FROM Hikes WHERE id = ?",$var);
    }
    public function getFavHikes($id){

        return $this->prepareAll('SELECT *,Hikes.id as HikeId  From Hikes 
                                        join UserFavHike UFH on Hikes.id = UFH.id_Hike 
                                        join Users U on U.id = UFH.id_User
                                        where U.id = ?',[$id]);
    }

    public function getHikesCreated($id){
        return $this->prepareAll('SELECT * From Hikes
            join Users U on U.id = Hikes.creator_id
            where U.id = ?',[$id]);
    }
    public function addToFav($hikeid, $userid){
        
        $result=$this->prepareAll("Select * from UserFavHike Where id_User=? AND id_Hike=?",[$userid,$hikeid]);
        if(empty($result)){
            $this->prepare(
                "
                    INSERT INTO UserFavHike (id_User, id_Hike) 
                    VALUES (?, ?)
                ",
                [$userid,$hikeid]
            );
        }else{
            $this->prepare(
                "
                    DELETE FROM UserFavHike WHERE id_User=? AND id_Hike=?",
                [$userid,$hikeid]
            );
        }


    }

    public function editH($name,$distance,$duration,$elevation,$description,$updated, $id){
        return $this->prepare("UPDATE Hikes SET name = ?, distance = ?, duration = ?, elevation_gain = ?,description = ?, updated_at=? WHERE id = ?;", [$name,$distance,$duration,$elevation,$description,$updated,$id]);

    }
    public function deleteH($hikeid){
        return $this->prepare("DELETE FROM Hikes WHERE id =  ?",[$hikeid]);
    }
}