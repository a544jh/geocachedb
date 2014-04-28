<?php
require_once 'libs/models/geocache.php';
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
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);

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
    
    //generates a random tracking code
    public static function generateTrackingcode() {
        $chars = array_merge(range(0, 9), range('A', 'Z'));
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
        $sql = "SELECT * FROM trackables;";
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
    
    public function updateInDb() {
        $sql = "UPDATE trackables SET name = ?, description = ? "
                . "WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getName(), $this->getDescription(), $this->getId()));
    }

    public function isValid() {
        return empty($this->errors);
    }

    public function userIsOwner() {
        return loggedIn() && $_SESSION['user']->getId() === $this->getOwner();
    }
    
    public static function trackablesOwnedBy($userid) {
        $sql = "SELECT * FROM trackables "
                . "WHERE ownerid = ?;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($userid));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            $results[] = $trackable;
        }
        return $results;
    }

    public static function trackablesHeldBy($user) {
        //the latest GRAB logs for each trackable made by user
        $sql = "SELECT * FROM trackables "
                . "INNER JOIN("
                . "SELECT tl.trackable, le.timestamp "
                . "FROM trackablelog tl, logentry le, "
                . "(SELECT tl.trackable, max(le.timestamp) "
                . "FROM trackablelog tl, logentry le "
                . "WHERE tl.action NOT IN ('visit', 'comment') AND tl.logentry=le.id "
                . "GROUP BY tl.trackable"
                . ") max "
                . "WHERE le.userid = ? AND (tl.action = 'grab' OR tl.action = 'create') "
                . "AND tl.logentry = le.id AND le.timestamp = max.max AND tl.trackable = max.trackable"
                . ") lg ON trackables.id = lg.trackable;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($user->getId()));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            $results[] = $trackable;
        }
        return $results;
    }

    public static function trackablesInCache($geocache) {
        //the latest DROP logs for each trackable for the geocache
        $sql = "SELECT * FROM trackables "
                . "INNER JOIN("
                . "SELECT tl.trackable, le.timestamp "
                . "FROM trackablelog tl, logentry le, "
                . "(SELECT tl.trackable, max(le.timestamp) "
                . "FROM trackablelog tl, logentry le "
                . "WHERE tl.action NOT IN ('visit', 'comment') AND tl.logentry=le.id "
                . "GROUP BY tl.trackable"
                . ") max "
                . "WHERE le.geocacheid = ? AND tl.action = 'drop' "
                . "AND tl.logentry = le.id AND le.timestamp = max.max AND tl.trackable = max.trackable"
                . ") lg ON trackables.id = lg.trackable;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($geocache->getId()));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $trackable = new Trackable();
            $trackable->setAllFields($result);
            $results[] = $trackable;
        }
        return $results;
    }

    public function getLocation() {
        //look for the latest trackablelog that changed the trackable's location
        $sql = "SELECT tl.logentry, tl.action, le.userid, le.geocacheid "
                . "FROM trackablelog tl, logentry le "
                . "WHERE tl.trackable = ? "
                . "AND (tl.action = 'grab' OR tl.action = 'create' OR tl.action = 'drop') "
                . "AND tl.logentry = le.id "
                . "ORDER BY le.timestamp desc LIMIT 1;";
        $logQuery = getDbConnection()->prepare($sql);
        $logQuery->execute(array($this->getId()));
        $logResult = $logQuery->fetchObject();
        //if it's a grab or create log, a user has the trackable
        if ($logResult->action == 'grab' OR $logResult->action == 'create') {
            return User::getUserById($logResult->userid);
            //otherwise it's in a geocache
        } else if ($logResult->action == 'drop') {
            return Geocache::getGeocacheById($logResult->geocacheid);
        }
    }

}
