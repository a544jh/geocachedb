<?php

class trackablemovelog {
    private $action;
    private $trackable;
    private $fromuser;
    
    public function getAction() {
        return $this->action;
    }

    public function getTrackable() {
        return $this->trackable;
    }

    public function getFromuser() {
        return $this->fromuser;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setTrackable($trackable) {
        $this->trackable = $trackable;
    }

    public function setFromuser($fromuser) {
        $this->fromuser = $fromuser;
    }


}
