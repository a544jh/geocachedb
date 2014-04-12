<?php

class Trackablelog {
    private $action;
    private $trackable;
    private $fromuser;
    
    function __construct($action, $trackable, $fromuser) {
        $this->action = $action;
        $this->trackable = $trackable;
        $this->fromuser = $fromuser;
    }

    
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

    public function actionMessage() {
        switch ($this->action) {
            case "create":
                return "Created";
        }
    }
    
}
