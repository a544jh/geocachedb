<?php
require_once 'libs/dbconnection.php';

class User{
    private $id;
    private $username;
    private $password;
    private $registred;
    private $role;
    private $bio;
    
    function __construct($id, $username, $password, $registred, $role, $bio) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->registred = $registred;
        $this->role = $role;
        $this->bio = $bio;
    }

    
    public function getUsername(){
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }

        
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRegistred() {
        return $this->registred;
    }

    public function getRole() {
        return $this->role;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRegistred($registred) {
        $this->registred = $registred;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public static function getUserByName($username){
        $sql = "SELECT * FROM users WHERE name = ? ";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($username));
        
        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $user = new User($result->id, $result->name, $result->password,
                    $result->registred, $result->role, $result->bio);
            
            return $user;
        }
    }
    
    public static function getUserById($id){
         $sql = "SELECT * FROM users WHERE id = ? ";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($id));
        
        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $user = new User($result->id, $result->name, $result->password,
                    $result->registred, $result->role, $result->bio);
            
            return $user;
        }
    }

    public static function getUsersList() {
        $sql = "SELECT * FROM users";
        $query = getDbConnection()->prepare($sql);
        $query->execute();
        
        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $user = new User($result->id, $result->name, $result->password,
                    $result->registred, $result->role, $result->bio);
            $results[] = $user;
        }
        return $results; 
    }
}