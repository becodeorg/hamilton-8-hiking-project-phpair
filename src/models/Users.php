<?php

namespace models;

class Users extends Database
{

    public function getAll(){
       return $this->fetchAll('Select * FROM Users WHERE isAdmin = 0');
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
        return $this->prepare('INSERT INTO Users (firstname, lastname, nickname, email,password,isAdmin) VALUES (?,?,?,?,?,?)',[$firstname, $lastname, $nickname, $email, $passwordHash,0]);
    }

}