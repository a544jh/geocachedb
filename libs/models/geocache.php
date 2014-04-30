<?php

class Geocache {

    private $id;
    private $type;
    private $name;
    private $description;
    private $hint;
    private $dateadded;
    private $owner;
    private $difficulty;
    private $terrain;
    private $latitude;
    private $longitude;
    private $published;
    private $archived;

//    function __construct($id, $type, $name, $description, $hint, $dateadded, $owner, $difficulty, $terrain, $latitude, $logitude, $ispublic, $archived) {
//        $this->id = $id;
//        $this->type = $type;
//        $this->name = $name;
//        $this->description = $description;
//        $this->hint = $hint;
//        $this->dateadded = $dateadded;
//        $this->owner = $owner;
//        $this->difficulty = $difficulty;
//        $this->terrain = $terrain;
//        $this->latitude = $latitude;
//        $this->longitude = $logitude;
//        $this->ispublic = $ispublic;
//        $this->archived = $archived;
//    }

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
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

    public function getLongitude() {
        return $this->longitude;
    }

    public function getPublished() {
        return $this->published;
    }

    public function getArchived() {
        return $this->archived;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setType($type) {
        $this->type = $type;
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

    public function setHint($hint) {
        $this->hint = filter_var($hint, FILTER_SANITIZE_STRING);
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

        if (!is_numeric($latitude)) {
            $this->errors['latitude'] = "Latitude must be numeric.";
        } else {
            unset($this->errors['latitude']);
        }
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        if (!is_numeric($longitude)) {
            $this->errors['longitude'] = "Longitude must be numeric.";
        } else {
            unset($this->errors['longitude']);
        }
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    public function setArchived($archived) {
        $this->archived = $archived;
    }

    function setAllFields($result) {
        $this->id = $result->id;
        $this->type = $result->type;
        $this->name = $result->name;
        $this->description = $result->description;
        $this->hint = $result->hint;
        $this->dateadded = $result->added;
        $this->owner = $result->ownerid;
        $this->difficulty = $result->difficulty;
        $this->terrain = $result->terrain;
        $this->latitude = $result->latitude;
        $this->longitude = $result->longitude;
        $this->published = $result->published;
        $this->archived = $result->archived;
    }

    public static function getGeocachesList() {
        $sql = "SELECT * FROM geocaches";
        $query = getDbConnection()->prepare($sql);
        $query->execute();

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            $results[] = $geocache;
        }
        return $results;
    }

    public static function searchByName($name, $published, $achived) {
        $sql = "SELECT * FROM geocaches "
                . "WHERE name LIKE :name AND published = :published AND archived = :archived";
        $query = getDbConnection()->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':published', $published, PDO::PARAM_BOOL);
        $query->bindParam(':archived', $achived, PDO::PARAM_BOOL);
        $query->execute();

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            $results[] = $geocache;
        }
        return $results;
    }

    public static function searchByCoords($lat, $lon) {
        $sql = "SELECT * , (6371 * acos(cos(radians(latitude)) * cos(radians(:lat)) * cos(radians(longitude) - radians(:lon)) + sin(radians(latitude)) * sin(radians(:lat)))) distance "
                . "FROM geocaches "
                . "WHERE published = true AND archived = false "
                . "ORDER BY distance";
        $query = getDbConnection()->prepare($sql);
        $query->bindParam(':lat', $lat);
        $query->bindParam(':lon', $lon);
        $query->execute();

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            $geocache->distance = $result->distance;
            $results[] = $geocache;
        }
        return $results;
    }
    
    public static function getCachesOwnedBy($userid) {
        $sql = "SELECT * FROM geocaches WHERE ownerid = ?";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($userid));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            $results[] = $geocache;
        }
        return $results;
    }
    
    public static function getCachesFoundBy($userid) {
        $sql = "SELECT * FROM geocaches "
                . "WHERE EXISTS ("
                . "SELECT 1 FROM logentry "
                . "WHERE geocacheid = geocaches.id "
                . "AND visittype = 'found' "
                . "AND userid = ? "
                . ") ;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($userid));

        $results = array();
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $result) {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            $results[] = $geocache;
        }
        return $results;
    }

    public static function getGeocacheById($id) {
        $sql = "SELECT * FROM geocaches WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($id));

        $result = $query->fetchObject();
        if ($result == null) {
            return null;
        } else {
            $geocache = new Geocache();
            $geocache->setAllFields($result);
            return $geocache;
        }
    }

    public function insertIntoDb() {
        $sql = "INSERT INTO geocaches(type, name, description, hint, ownerid, difficulty, terrain, latitude, longitude) "
                . "VALUES (?,?,?,?,?,?,?,?,?) RETURNING id;";
        $query = getDbConnection()->prepare($sql);
        $ok = $query->execute(array($this->getType(), $this->getName(),
            $this->getDescription(), $this->getHint(),
            $this->getOwner(), $this->getDifficulty(),
            $this->getTerrain(), $this->getLatitude(), $this->getLongitude()));

        if ($ok) {
            $this->setId($query->fetchColumn());
        }
        return $ok;
    }

    public function updateInDb() {
        $sql = "UPDATE geocaches SET type = ?, name = ?, description = ?, "
                . "difficulty = ?, terrain = ?, latitude = ?, longitude = ?"
                . "WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getType(), $this->getName(),
                    $this->getDescription(), $this->getDifficulty(), $this->getTerrain(),
                    $this->getLatitude(), $this->getLongitude(), $this->getId()));
    }

    public function publish() {
        $this->setPublished(true);

        $sql = "UPDATE geocaches SET published = true WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getId()));
    }

    public function archive() {
        $this->setArchived(true);

        $sql = "UPDATE geocaches SET archived = true WHERE id = ?";
        $query = getDbConnection()->prepare($sql);
        return $query->execute(array($this->getId()));
    }

    public function isValid() {
        return empty($this->errors);
    }

    //returns true if the logged in user is the owner of the geocache
    public function userIsOwner() {
        return loggedIn() && $_SESSION['user']->getId() === $this->getOwner();
    }

    //returns the number of users who made a log for the cache of a certain type, e.g. 'found'
    public function visittypeCount($type) {
        $sql = "SELECT count(*) FROM ("
                . "SELECT DISTINCT userid "
                . "FROM logentry "
                . "WHERE geocacheid = ? AND visittype = ? "
                . ") a;";
        $query = getDbConnection()->prepare($sql);
        $query->execute(array($this->getId(), $type));

        $result = $query->fetchObject();
        if ($result == null) {
            return 0;
        } else {
            return $result->count;
        }
    }
    
    public function getLink() {
        $del = ($this->archived ? "<del>" : "");
        $delend = ($this->archived ? "</del>" : "");
        return "$del<a href=\"geocacheview.php?id=$this->id\">$this->name</a>$delend";
    }

}
