<?php

class Senator {
    private $id;
    private $name;
    private $location;
    private $member;
    private $type;
    private $committee;

    // Type: {0 => Elected, 1 => Appointed}

    public function __construct($id) {
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
}