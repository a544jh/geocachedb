<?php

require_once 'libs/dbconnection.php';

class User {

    private $id;
    private $username;
    private $password;
    private $registered;
    private $role;
    private $bio;

//    function __construct($id, $username, $password, $registred, $role, $bio) {
//        $this->id = $id;
//        $this->username = $username;
//        $this->password = $password;
//        $this->registred = $registred;
//        $this->role = $role;
//        $this->bio = $bio;
//    }


    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;

        if (trim($this->username) === '') {
            $this->errors['username'] = "Username may not be empty.";
        } else if ($this->username != filter_var($this->username, FILTER_SANITIZE_STRING)) {
            $this->errors['username'] = "Username contains invalid characters.";
        } else if (User::getUserByName($this->username) != null) {
            $this->errors['username'] = "Username is already taken.";
        } else {
            unset($this->errors['username']);
        }
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

    public function getRegistered() {
        return $this->registered;
    }

    public function getRole() {
        return $this->role;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setPassword($password) {
        if (trim($password) === '') {
            $this->errors['password'] = "Password may not be empty.";
        } else {
            unset($this->errors['password']);
        }
        //encrypt the password
        $this->password = crypt($password);
    }

    public function setRegistered($registred) {
        $this->registered = $registred;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    function setAllFields($result) {
        $this->id = $result->id;
        $this->username = $result->name;
        $this->password = $result->password;
        $this->registered = $result->registered;
        $this->role = $result->role;
        $this->bio = $result->bio;
    }

    public static function getUserByName($username) {
        $sql = "SELECT * FROM users WHERE name = ? ";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($username));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $user = new User();
            $user->setAllFields($result);
            return $user;
        }
    }

    public static function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ? ";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($id));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $user = new User();
            $user->setAllFields($result);
            return $user;
        }
    }

    public static function getUsersList() {
        $sql = "SELECT * FROM users";
        $query = getDbConnection()->prepare($sql);
        $query->execute();

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $user = new User();
            $user->setAllFields($result);
            $results[] = $user;
        }
        return $results;
    }

    //returns the number of geocaches the user has made a log on of a certain type, e.g. 'found'
    public function visittypeCount($type) {
        $sql = "SELECT count(*) FROM ("
                . "SELECT DISTINCT geocacheid "
                . "FROM logentry "
                . "WHERE userid = ? AND visittype = ? "
                . ") a;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($this->getId(), $type));

        $result = $query->fetchObject();
        if ($result == null) {
            return 0;
        } else {
            return $result->count;
        }
    }

    public function insertIntoDb() {
        $sql = "INSERT INTO users(name, password, role, bio) "
                . "VALUES (?, ?, ?, ?) RETURNING id;";
        $query = getDbConnection()->prepare($sql);
        $ok = $query->execute(array($this->getUsername(), $this->getPassword(), $this->getRole(), $this->getBio()));

        if ($ok) {
            $this->setId($query->fetchColumn());
        }
        return $ok;
    }

    public function updateInDb() {
        $sql = "UPDATE users SET name = ?, password = ?, role = ?, bio = ? "
                . "WHERE id = ?;";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getUsername(), $this->getPassword(),
                    $this->getRole(), $this->getBio(), $this->getId()));
    }

    public function isValid() {
        return empty($this->errors);
    }

    public function checkPassword($password) {
        return crypt($password, $this->getPassword()) === $this->getPassword();
    }
    
    public function getLink() {
        return "<a href=\"userprofile.php?id=$this->id\">$this->username</a>";
    }

}
