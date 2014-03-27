<?php

class logentry {
    private $id;
    private $user;
    private $comment;
    private $edited;
    private $geocachevisit; //geocacheid and visittype, to be kept in an array
    private $trackableVisitLogs; //arrays of logs
    private $trackableMoveLogs;
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getEdited() {
        return $this->edited;
    }

    public function getGeocachevisit() {
        return $this->geocachevisit;
    }
    
    public function getTrackableVisitLogs() {
        return $this->trackableVisitLogs;
    }

    public function getTrackableMoveLogs() {
        return $this->trackableMoveLogs;
    }

    
    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setEdited($edited) {
        $this->edited = $edited;
    }

    public function setGeocachevisit($geocachevisit) {
        $this->geocachevisit = $geocachevisit;
    }
    
    public function setTrackableVisitLogs($trackableVisitLogs) {
        $this->trackableVisitLogs = $trackableVisitLogs;
    }

    public function setTrackableMoveLogs($trackableMoveLogs) {
        $this->trackableMoveLogs = $trackableMoveLogs;
    }




}
