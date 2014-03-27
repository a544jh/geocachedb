<?php
class geocache {
    private $id;
    private $name;
    private $description;
    private $hint;
    private $dateadded;
    private $owner;
    private $difficulty;
    private $terrain;
    private $latitude;
    private $logitude;
    private $archived;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getHint() {
        return $this->hint;
    }

    public function getDateadded() {
        return $this->dateadded;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function getTerrain() {
        return $this->terrain;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLogitude() {
        return $this->logitude;
    }

    public function getArchived() {
        return $this->archived;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setHint($hint) {
        $this->hint = $hint;
    }

    public function setDateadded($dateadded) {
        $this->dateadded = $dateadded;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function setDifficulty($difficulty) {
        $this->difficulty = $difficulty;
    }

    public function setTerrain($terrain) {
        $this->terrain = $terrain;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLogitude($logitude) {
        $this->logitude = $logitude;
    }

    public function setArchived($archived) {
        $this->archived = $archived;
    }


    
}
