<?php
require_once 'libs/models/trackablelog.php';
class Logentry {

    private $id;
    private $user;
    private $comment;
    private $timestamp;
    private $edited;
    private $geocacheid;
    private $visittype;
    private $trackableLogs; //arrays of logs
    static $visitMessages = array('found' => "Found it!", 'dnf' => "Didn't find it.",
        'comment' => "Left a comment.");
    public $errors = array();

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

    public function getTrackableLogs() {
        return $this->trackableLogs;
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
    
    public function userIsOwner() {
        return loggedIn() && $_SESSION['user']->getId() === $this->getUser();
    }

    function setAllFields($result) {
        $this->id = $result->id;
        $this->user = $result->userid;
        $this->comment = $result->comment;
        $this->timestamp = $result->timestamp;
        $this->edited = $result->edited;
        $this->geocacheid = $result->geocacheid;
        $this->visittype = $result->visittype;
        $this->attachTrackableLogs();
    }
    
    function attachTrackableLogs() {
        $sql = "SELECT * FROM trackablelog "
                . "WHERE logentry = ? ;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($this->getId()));
        
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
        $this->trackableLogs[] = new Trackablelog($result->action, $result->trackable, $result->fromuser);
        }
    }
    
    public static function getLogentryById($id){
        $sql = "SELECT * FROM logentry WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($id));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $logentry = new Logentry();
            $logentry->setAllFields($result);
            return $logentry;
        }
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
    
    public static function getLogsForTrackable ($trackable) {
        $sql = "SELECT * FROM logentry "
                . "INNER JOIN ( "
                . "SELECT * FROM trackablelog "
                . "WHERE trackable = ? ) tl "
                . "ON tl.logentry = logentry.id "
                . "ORDER BY timestamp desc;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($trackable->getId()));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $logentry = new Logentry();
            $logentry->setAllFields($result);
            $results[] = $logentry;
        }
        return $results;
    }
    
    public static function getLogsByUser($user) {
        $sql = "SELECT * FROM logentry "
                . "WHERE userid = ? "
                . "ORDER BY timestamp desc;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($user->getId()));

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
    
    public function updateInDb() {
        $sql = "UPDATE logentry SET comment = ?, edited = current_timestamp "
                . "WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getComment(), $this->getId()));
    }
    
    public function delete() {
        $sql = "DELETE from trackablelog WHERE logentry = ?;";
        $sql1 = "DELETE from logentry WHERE id = ?;";
        $query = getDbConnection()->prepare($sql);
        $query1 = getDbConnection()->prepare($sql1);
        $query->execute(array($this->getId()));
        return $query1->execute(array($this->getId()));
    }

}
