<?php
    class Rank {
        private $id;
        private $name;
        private $division;
        private $abbrev;
        private $paygrade;

        /**
         * @param $id
         */
        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM ranks WHERE id = $id");
            $result = $query->fetch_array();

            extract($result);

            $this->id = $id;
            $this->name = $name;
            $this->abbrev = $abbrev;
            $this->paygrade = $rank;

            $this->division = new Division($division);
        }

        /**
         * @param User $user
         * @return array
         */
        public static function getRanks(User $user) {
            global $mysqli;

            $ranks = array();

            $query = $mysqli->query("SELECT * FROM ranks");
            while ($result = $query->fetch_array()) {
                $rank = new self($result['id']);
                if ($user->getAdmin() || $user->isThrone() || ($user->isDivCommand() && ($user->getDivision()->isSame($rank->getDivision()) || ($user->getDivision()->isAbove($rank->getDivision()))))) {
                    $ranks[] = $rank;
                }
            }

            return $ranks;
        }

        /**
         * @param Division $division
         * @return Rank[]
         */
        public static function getDivisionRanks(Division $division) {
            global $mysqli;

            $ranks = array();

            $paygrades = array('E', 'O', 'C', 'HC', 'RT', 'S');

            foreach ($paygrades as $paygrade) {
                $query = $mysqli->query("SELECT * FROM ranks WHERE division = {$division->getDivision()} AND rank LIKE '$paygrade%' ORDER BY rank");
                if ($query->num_rows > 0) {
                    while ($result = $query->fetch_array()) {
                        $ranks[] = new self($result['id']);
                    }
                }
            }

            return $ranks;
        }

        public static function create($name, $div, $abbrev, $paygrade) {
            global $mysqli;

            $insert = $mysqli->query("INSERT INTO ranks VALUE (NULL, '$name', $div, '$abbrev', '$paygrade')");
            if (!$insert) {
                throw new DBException('Could not create new rank.', $mysqli->error);
            }
        }

        /**
         * @return int
         */
        public function getRank() {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return string
         */
        public function getAbbrev() {
            return $this->abbrev;
        }

        /**
         * @return string
         */
        public function getPaygrade() {
            return $this->paygrade;
        }

        /**
         * @return Division
         */
        public function getDivision() {
            return $this->division;
        }

        public function update($name, $div, $abbrev, $paygrade) {
           global $mysqli;

            $update = $mysqli->query("UPDATE ranks SET name = '$name', division = $div, abbrev = '$abbrev', rank = '$paygrade' WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update rank.', $mysqli->error);
            }
        }

        public function delete() {
            global $mysqli;

            $delete = $mysqli->query("DELETE FROM ranks WHERE id = {$this->id}");
            if (!$delete) {
                throw new DBException('Could not update rank.', $mysqli->error);
            }
        }
    }