<?php

class Trackable {
    private $id;
    private $name;
    private $description;
    private $dateadded;
    private $owner;
    private $trackingcode;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateadded() {
        return $this->dateadded;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getTrackingcode() {
        return $this->trackingcode;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = filter_var($name,FILTER_SANITIZE_STRING);

        if (trim($this->name) == '') {
            $this->errors['name'] = "Name may not be empty.";
        } else {
            unset($this->errors['name']);
        }
    }

    public function setDescription($description) {
        $this->description = $description;

        if (trim($this->description) == '') {
            $this->errors['description'] = "Description may not be empty.";
        } else {
            unset($this->errors['description']);
        }
    }

    public function setDateadded($dateadded) {
        $this->dateadded = $dateadded;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function setTrackingcode($trackingcode) {
        $this->trackingcode = $trackingcode;
    }
    
    function setAllFields($result) {
        $this->id = $result->id;
        $this->name = $result->name;
        $this->description = $result->description;
        $this->dateadded = $result->added;
        $this->owner = $result->ownerid;
        $this->trackingcode = $result->trackingcode;
    }

    public static function generateTrackingcode(){
        $chars = array_merge(range(0,9), range('A', 'Z'));
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $code;
    }
    
    public static function getTrackableById($id) {
        $sql = "SELECT * FROM trackables WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($id));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            return $trackable;
        }
    }
    
    public static function getTrackableByTrackingcode($code) {
        $sql = "SELECT * FROM trackables WHERE trackingcode = ?";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($code));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            return $trackable;
        }
    }
    
    public static function getTrackablesList() {
        $sql = "SELECT * FROM trackables";
        $query = getDbConnection()->prepare($sql);
        $query->execute();

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            $results[] = $trackable;
        }
        return $results;
    }
    
    public function insertIntoDb() {
        $sql = "INSERT INTO trackables (name, description, ownerid, trackingcode) "
                . "VALUES(?, ?, ?, ?) RETURNING id;";
        $query = getDbConnection()->prepare($sql);
        $ok = $query->execute(array($this->getName(), $this->getDescription(), $this->getOwner(), $this->getTrackingcode()));

        if ($ok) {
            $this->setId($query->fetchColumn());
        }
        return $ok;
    }
    
    public function isValid() {
        return empty($this->errors);
    }
    
    public function userIsOwner() {
        return loggedIn() && $_SESSION['user']->getId() === $this->getOwner();
    }
    

}
