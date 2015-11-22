<?php

class Year {
    private $id;
    private $year;
    private $era;
    private $date;
    private $latest = false;

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM irclock WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->year = $year;
        $this->date = $date;

        if ($latest == 1) {
            $this->latest = true;
        }

        if ($era == 1)
            $this->era = 'UFY';
        else
            $this->era = 'IRY';
    }

    /**
     * @param $page
     * @return Year[]
     */
    public static function getYears($page) {
        global $mysqli;

        $allYears = array();
        $years = array();

        $start = ($page - 1) * 10;

        $query = $mysqli->query("SELECT * FROM irclock WHERE era = 2 ORDER BY year DESC");
        while ($result = $query->fetch_array()) {
            $allYears[] = new self($result['id']);
        }

        $query = $mysqli->query("SELECT * FROM irclock WHERE era = 1 ORDER BY year ASC");
        while ($result = $query->fetch_array()) {
            $allYears[] = new self($result['id']);
        }

        if ($start + 10 > self::getTotalYears())
            $max = self::getTotalYears();
        else
            $max = $start + 10;

        for ($i = $start; $i < $max; $i++) {
            $years[] = $allYears[$i];
        }

        return $years;
    }

    public static function getTotalYears() {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM irclock");
        return $query->num_rows;
    }

    /**
     * @return Year
     */
    public static function getCurrentYear() {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM irclock WHERE latest = 1");
        $result = $query->fetch_array();

        return new self($result['id']);
    }

    public static function create($year, $era) {
        global $mysqli;

        $update = $mysqli->query("UPDATE irclock SET latest = 0 WHERE latest = 1");
        if (!$update) {
            throw new DBException('Could not add a new IR year.', $mysqli->error);
        }

        $insert = $mysqli->query("INSERT INTO irclock VALUES (NULL, $year, $era, NOW(), 1)");
        if (!$insert) {
            throw new DBException('Could not add a new IR year.', $mysqli->error);
        }
    }

    public function getID() {
        return $this->id;
    }

    public function getFullYear() {
        return $this->year . ' ' . $this->era;
    }

    public function getDate() {
        return date('F j, Y', strtotime($this->date));
    }

    public function isCurrent() {
        return $this->latest;
    }

    public function makeCurrent() {
        global $mysqli;

        $update = $mysqli->query("UPDATE irclock SET latest = 0 WHERE latest = 1");
        if (!$update) {
            throw new DBException('Could not update current IR year.', $mysqli->error);
        }

        $update = $mysqli->query("UPDATE irclock SET latest = 1 WHERE id = {$this->id}");
        if (!$update) {
            throw new DBException('Could not update current IR year.', $mysqli->error);
        }
    }
}