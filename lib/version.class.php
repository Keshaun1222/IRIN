<?php

class Version {
    private $id;
    private $version;
    private $date;
    private $latest = false;

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM version WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->version = $version;
        $this->date = $vtimestamp;

        if ($latest == 1) {
            $this->latest = true;
        }
    }

    /**
     * @return Version[]
     */
    public static function getVersions() {
        global $mysqli;

        $versions = array();

        $query = $mysqli->query("SELECT * FROM version ORDER BY id DESC");
        while($result = $query->fetch_array()) {
            $versions[] = new self($result['id']);
        }

        return $versions;
    }

    /**
     * @return Version
     */
    public static function getLatestVersion() {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM version WHERE latest = 1");
        $result = $query->fetch_array();

        return new self($result['id']);
    }

    public static function create($version) {
        global $mysqli;

        $update = $mysqli->query("UPDATE version SET latest = 0 WHERE latest = 1");
        if (!$update) {
            throw new DBException('Could not add a new version.', $mysqli->error);
        }

        $insert = $mysqli->query("INSERT INTO version VALUES (NULL, '$version', NOW(), 1)");
        if (!$insert) {
            throw new DBException('Could not add a new version.', $mysqli->error);
        }
    }

    public function getID() {
        return $this->id;
    }

    public function getVersion() {
        return $this->version;
    }

    public function getDate() {
        return date('F j, Y', strtotime($this->date));
    }

    public function isCurrent() {
        return $this->latest;
    }

    public function makeCurrent() {
        global $mysqli;

        $update = $mysqli->query("UPDATE version SET latest = 0 WHERE latest = 1");
        if (!$update) {
            throw new DBException('Could not update current version.', $mysqli->error);
        }

        $update = $mysqli->query("UPDATE version SET latest = 1 WHERE id = {$this->id}");
        if (!$update) {
            throw new DBException('Could not update current version.', $mysqli->error);
        }
    }
}