<?php

class Trackablelog {
    private $action;
    private $trackableid;
    private $fromuser;
    
    function __construct($action, $trackableid, $fromuser) {
        $this->action = $action;
        $this->trackableid = $trackableid;
        $this->fromuser = $fromuser;
    }

    
    public function getAction() {
        return $this->action;
    }

    public function getTrackableid() {
        return $this->trackableid;
    }

    public function getFromuser() {
        return $this->fromuser;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setTrackableid($trackableid) {
        $this->trackableid = $trackableid;
    }

    public function setFromuser($fromuser) {
        $this->fromuser = $fromuser;
    }

    public function insertIntoDb($logentry) {
        $sql = "INSERT INTO trackablelog "
                . "VALUES(?, ?, ?, ?);";
        $query = getDbConnection()->prepare($sql);
        $ok = $query->execute(array($logentry->getId(), $this->getAction(), $this->getTrackableid(), $this->getFromuser()));
        return $ok;
    }
    
}
