<?php


class trackablevisitedlog {
    private $trackable;
    private $visittype;
    
    public function getTrackable() {
        return $this->trackable;
    }

    public function getVisittype() {
        return $this->visittype;
    }

    public function setTrackable($trackable) {
        $this->trackable = $trackable;
    }

    public function setVisittype($visittype) {
        $this->visittype = $visittype;
    }


}
