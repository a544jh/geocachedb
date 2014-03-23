<?php
require 'libs/dbconnection.php';
class User{
    private $id;
    private $username;
    private $password;
    private $registred;
    private $role;
    private $bio;
    
    public function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public static function getUsersList() {
        $sql = "SELECT * FROM users";
        $query = getDbConnection()->prepare($sql);
        $query->execute();
        
        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $user = new User($result->id, $result->name, $result->password);
            $results[] = $user;
        }
        return $results; 
    }
}