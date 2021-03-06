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

        $query = $mysqli->query("SELECT * FROM oaths WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->user = new User($user);
        $this->division = new Division($division);
        $this->administered = new User($administered);

        foreach (explode(',', $witnesses) as $witness) {
            $this->witnesses[] = new User($witness);
        }

        $this->date = date('m/d/Y', strtotime($timestamp));
    }

    public static function recordOath($user, $division, $administered, $witnesses = array()) {
        global $mysqli;

        $witnessList = implode(',', $witnesses);

        $insert = $mysqli->query("INSERT INTO oaths VALUE(NULL, $user, $division, $administered, '$witnessList', NULL)");
    }

    public static function getOaths(Division $division = null) {
        global $mysqli;

        $oaths = array();

        $query = $mysqli->query("SELECT * FROM oaths");
        while($result = $query->fetch_array()) {
            if (!isset($division) || $division->getDivision() == $result['division'])
                $oaths[] = new Oath($result['id']);
        }

        return $oaths;
    }

    public function getID() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getDivision() {
        return $this->division;
    }

    public function getAdministered() {
        return $this->administered;
    }

    public function getWitnesses() {
        return $this->witnesses;
    }

    public function getDate() {
        return $this->date;
    }
}