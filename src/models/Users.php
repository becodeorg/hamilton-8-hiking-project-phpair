<?php

namespace models;

class Users extends Database
{

    public function getAll(){
       return $this->fetchAll('Select * FROM Users WHERE id > 1');
    }

    public function get($nickname){
        return $this->prepare("SELECT * FROM Users WHERE nickname = ?", [$nickname]);
    }

    public function remove($id){
        return $this->prepare('DELETE FROM Users WHERE id =  ?',[$id]);
    }

    public function modify($id,$firstname,$lastname,$nickname,$email,$passwordHash){
        return $this->prepare("UPDATE Users SET firstname = ?, lastname = ?, nickname = ?, email = ?,password = ? WHERE id = ?;", [$firstname, $lastname, $nickname, $email, $passwordHash, $id]);

    }

    public function add($firstname,$lastname,$nickname,$email,$passwordHash){
        return $this->prepare('INSERT INTO Users (firstname, lastname, nickname, email,password) VALUES (?,?,?,?,?)',[$firstname, $lastname, $nickname, $email, $passwordHash]);
    }

    public function getFavHikes($id){

        return $this->prepareAll('SELECT *,Hikes.id as HikeId  From Hikes 
                                        join UserFavHike UFH on Hikes.id = UFH.id_Hike 
                                        join Users U on U.id = UFH.id_User
                                        where U.id = ?',[$id]);
    }

    public function getHikesCreated($id){
        return $this->prepareAll('SELECT *,Hikes.id as HikeId From Hikes
                                        join Users U on U.id = Hikes.creator_id
                                        where U.id = ?',[$id]);
    }

}