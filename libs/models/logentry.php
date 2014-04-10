<?php

class Logentry {

    private $id;
    private $user;
    private $comment;
    private $timestamp;
    private $edited;
    private $geocacheid;
    private $visittype;
    private $trackableVisitLogs; //arrays of logs
    private $trackableMoveLogs;
    static $visitMessages = array('found' => "Found it!", 'dnf' => "Didn't find it.",
        'comment' => "Left a comment.");

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getEdited() {
        return $this->edited;
    }

    public function getGeocacheid() {
        return $this->geocacheid;
    }

    public function getVisittype() {
        return $this->visittype;
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

        if (trim($this->comment) == '') {
            $this->errors['comment'] = "Comment may not be empty.";
        } else {
            unset($this->errors['name']);
        }
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function setEdited($edited) {
        $this->edited = $edited;
    }

    public function setGeocacheid($geocacheid) {
        $this->geocacheid = $geocacheid;
    }

    public function setVisittype($visittype) {
        $this->visittype = $visittype;
    }

    public function setTrackableVisitLogs($trackableVisitLogs) {
        $this->trackableVisitLogs = $trackableVisitLogs;
    }

    public function setTrackableMoveLogs($trackableMoveLogs) {
        $this->trackableMoveLogs = $trackableMoveLogs;
    }

    public function isValid() {
        return empty($this->errors);
    }

    function setAllFields($result) {
        $this->id = $result->id;
        $this->user = $result->userid;
        $this->comment = $result->comment;
        $this->timestamp = $result->timestamp;
        $this->edited = $result->edited;
        $this->geocacheid = $result->geocacheid;
        $this->visittype = $result->visittype;
    }

    public static function getLogsForCache($geocache) {
        $sql = "SELECT * FROM logentry "
                . "WHERE geocacheid = ? "
                . "ORDER BY timestamp desc";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($geocache->getId()));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $logentry = new Logentry();
            $logentry->setAllFields($result);
            $results[] = $logentry;
        }
        return $results;
    }

    public function insertIntoDb() {
        $sql = "INSERT INTO logentry (userid, comment, geocacheid, visittype) "
                . "VALUES(?, ?, ?, ?) RETURNING id;";
        $query = getDbConnection()->prepare($sql);
        $ok = $query->execute(array($this->getUser()->getId(), $this->getComment(), $this->getGeocacheid(), $this->getVisittype()));

        if ($ok) {
            $this->setId($query->fetchColumn());
        }
        return $ok;
    }

}
