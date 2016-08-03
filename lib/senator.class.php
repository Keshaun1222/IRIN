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
    }

    public static function registerSenator($name, $location, $user) {
        global $mysqli;
    }

    public static function approveSenator($id, $type, $committee) {
        global $mysqli;
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
        return $this->type;
    }

    public function getCommittee() {
        return $this->committee;
    }

    public function isActive() {
        return $this->active;
    }
}