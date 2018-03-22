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

    public static function approveSenator($id, $type, $committee) {
        global $mysqli;

        $update = $mysqli->query("UPDATE senators SET type = $type, committee = $committee, active = 1 WHERE id = $id");
        if (!$update) {
            throw new DBException('Could not approve new senator.', $mysqli->error);
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
}