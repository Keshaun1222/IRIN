<?php
    class Division {
        private $id;
        private $name;
        private $parent = false;

        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM divisions WHERE div_id = $id");
            if (!$query)
                throw new DBException('Can\'t get division.', $mysqli->error);
            $result = $query->fetch_array();

            extract($result);

            $this->id = $id;
            $this->name = $div_name;

            if ($subdiv != NULL) {
                $this->parent = new self($subdiv);
            }
        }

        /**
         * @return Division[]
         */
        public static function getAllDivisions() {
            global $mysqli;

            $divisions = array();

            $query = $mysqli->query("SELECT * FROM divisions");
            while($result = $query->fetch_array()) {
                $divisions[] = new self($result['div_id']);
            }

            return $divisions;
        }

        public static function createDivision($name, $subdiv = NULL) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM divisions WHERE div_name = '$name'");
            if ($query->num_rows != 0) {
                return false;
            }

            if (isset($subdiv)) {
                $mysqli->query("INSERT INTO divisions VALUES (NULL, '$name', $subdiv)");
            } else {
                $mysqli->query("INSERT INTO divisions VALUES (NULL, '$name', NULL)");
            }
        }

        public function getDivision() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getParent() {
            return $this->parent;
        }

        public function isSame(Division $division) {
            if ($this->getDivision() == $division->getDivision()) {
                return true;
            }
            return false;
        }

        public function isAbove(Division $division) {
            if ($division->getParent()->getParent() && $division->getParent()->getParent()->getDivision() == $this->getDivision()) {
                    return true;
            }
            if ($division->getParent() && $division->getParent()->getDivision() == $this->getDivision()) {
                return true;
            }
            return false;
        }

        /**
         * @return Division[]
         */
        public function getSubDivisions() {
            global $mysqli;

            $divisions = array();

            $query = $mysqli->query("SELECT * FROM divisions WHERE subdiv = {$this->id}");
            while($result = $query->fetch_array()) {
                $divisions[] = new self($result['div_id']);
            }

            return $divisions;
        }

        public function hasSubDivisions() {
            if (count($this->getSubDivisions()) > 0)
                return true;
            return false;
        }
    }