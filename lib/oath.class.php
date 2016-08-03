<?php
class Oath {
    private $id;
    private $user;
    private $division;
    private $administered;
    private $witnesses = array();
    private $date;

    public function __construct($id) {
        global $mysqli;
    }

    public static function recordOath($user, $division, $administered, $witnesses = array()) {
        global $mysqli;
    }

    public function getID() {

    }

    public function getUser() {

    }

    public function getDivision() {

    }

    public function getAdministered() {

    }

    public function getWitnesses() {

    }

    public function getDate() {

    }
}