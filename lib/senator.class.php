<?php

class Senator {
    private $id;
    private $name;
    private $location;
    private $member;
    private $type;
    private $committee;
    private $active;

    private static $committees = array();

    // Type: {0 => Elected, 1 => Appointed}

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM senators WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->member = new User($member);
        $this->type = $type;
        $this->committee = $committee;
        $this->active = $active;
    }

    public static function registerSenator($name, $location, $user) {
        global $mysqli;

        $insert = $mysqli->query("INSERT INTO senators VALUE (NULL, '$name', '$location', $user, NULL, NULL, 0)");
        if (!$insert) {
            throw new DBException('Could not register new senator.', $mysqli->error);
        }
    }

    public static function getPendingSenators() {
        global $mysqli;

        $senators = array();

        $query = $mysqli->query("SELECT * FROM senators WHERE active = 0 AND type = NULL AND committee = NULL");
        while($result = $query->fetch_array()) {
            $senators[] = new Senator($result['id']);
        }

        return $senators;
    }

    public static function getInactiveSenators() {
        global $mysqli;

        $senators = array();

        $query = $mysqli->query("SELECT * FROM senators WHERE active = 0 AND type <> NULL AND committee <> NULL");
        while($result = $query->fetch_array()) {
            $senators[] = new Senator($result['id']);
        }

        return $senators;
    }

    public static function getSenators() {
        global $mysqli;

        $senators = array();

        $query = $mysqli->query("SELECT * FROM senators WHERE active = 1");
        while($result = $query->fetch_array()) {
            $senators[] = new Senator($result['id']);
        }

        return $senators;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getMember() {
        return $this->member;
    }

    public function getType() {
        return ($this->type == 1 ? 'Appointed' : 'Elected');
    }

    public function getCommittee() {
        return self::$committees[$this->committee];
    }

    public function isActive() {
        return ($this->active == 1 ? true : false);
    }

    public function setType($type) {
        global $mysqli;

        $update = $mysqli->query("UPDATE senators SET type = $type WHERE id = $this->id");

        if (!$update) {
            throw new DBException('Could not update senator.', $mysqli->error);
        }
    }

    public function setCommittee($committee) {
        global $mysqli;

        $update = $mysqli->query("UPDATE senators SET committee = $committee WHERE id = $this->id");

        if (!$update) {
            throw new DBException('Could not update senator.', $mysqli->error);
        }
    }

    public function setActive() {
        global $mysqli;

        $update = $mysqli->query("UPDATE senators SET active = 1 WHERE id = $this->id");

        if (!$update) {
            throw new DBException('Could not update senator.', $mysqli->error);
        }
    }

    public function setInactive() {
        global $mysqli;

        $update = $mysqli->query("UPDATE senators SET active = 0 WHERE id = $this->id");

        if (!$update) {
            throw new DBException('Could not update senator.', $mysqli->error);
        }
    }

    public function approve($type, $committee) {
        $this->setActive();
        $this->setType($type);
        $this->setCommittee($committee);
    }
}