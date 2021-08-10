<?php
    class Admin {
        private $id;
        /**
         * @var int
         */
        private $level;

        /**
         * @var Division[]
         */
        private $teams = array(); //Index 0 is primary team

        /**
         * @var string[]
         */
        private static $ranks = array('None', 'Team Member', 'Team Leader', 'Assistant Administrator', 'Senior Assistant Administrator', 'Lead Administrator');

        /**
         * @param int $id
         */
        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM admin WHERE userid = $id");
            $result = $query->fetch_array();

            extract($result);

            $this->id = $userid;
            $this->level = $rank;

            foreach (explode(',', $teams) as $team) {
                $this->teams[] = new Division($team);
            }
        }

        /**
         * @return User[]
         */
        public static function getAdmins() {
            global $mysqli;

            $users = array();

            $query = $mysqli->query("SELECT * FROM admin");
            while ($result = $query->fetch_array()) {
                $users[] = new User($result['userid']);
            }

            return $users;
        }

        public static function getAdminRanks() {
            return static::$ranks;
        }

        public static function create($userid, $rank, $teams = array()) {
            global $mysqli;

            $string = implode(',', $teams);

            $insert = $mysqli->query("INSERT INTO admin VALUES ($userid, $rank, '$string')");
            if (!$insert) {
                throw new DBException('Could not create new admin.', $mysqli->error);
            }

            $update = $mysqli->query("UPDATE users SET clearance = 7 WHERE id = $userid");
            if (!$update) {
                throw new DBException('Could not create new admin.', $mysqli->error);
            }
        }

        /**
         * @return string
         */
        public function getTitle() {
            $rank = static::$ranks[$this->level];
            $team = $this->teams[0]->getName();

            if ($this->level < 3) {
                $title = $team . ' ' . $rank;
            } else if ($this->level < 5) {
                $title = $rank . ' of ' . $team;
            } else {
                $title = $rank;
            }

            return $title;
        }

        /**
         * @return int
         */
        public function getAdminLevel() {
            return $this->level;
        }

        public function getAdminRank() {
            return static::$ranks[$this->level];
        }

        public function getAdminAbbrev() {
            $abbrev = '';

            foreach (explode(' ', $this->getAdminRank()) as $rank) {
                $abbrev .= strtoupper($rank[0]);
            }

            return $abbrev;
        }

        /**
         * @return Division
         */
        public function getPrimaryTeam() {
            return $this->teams[0];
        }

        /**
         * @return Division[]
         */
        public function getTeams() {
            return $this->teams;
        }

        /**
         * @return Division[]
         */
        public function getOtherTeams() {
            $teams = $this->teams;
            array_shift($teams);
            return $teams;
        }

        public function update($rank, $teams = array()) {
            global $mysqli;

            $string = implode(',', $teams);

            $update = $mysqli->query("UPDATE admin SET rank = $rank, teams = '$string' WHERE userid = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update admin.', $mysqli->error);
            }
        }

        public function remove() {
            global $mysqli;

            $update = $mysqli->query("UPDATE users SET clearance = 1 WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not remove admin.', $mysqli->error);
            }

            $update = $mysqli->query("UPDATE users SET admin = 0 WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not remove admin.', $mysqli->error);
            }

            $delete = $mysqli->query("DELETE FROM admin WHERE userid = {$this->id}");
            if (!$delete) {
                throw new DBException('Could not update admin.', $mysqli->error);
            }
        }
    }