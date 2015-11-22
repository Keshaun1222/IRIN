<?php
    class DocStatus {
        private $id;

        private static $types = array('None', 'For Review', 'Complete', 'Revoked', 'New', 'In Process', 'Permanent');

        public function __construct($id) {
            $this->id = $id;
        }

        public static function getAllTypes() {
            return static::$types;
        }

        public function getStatus() {
            return $this->id;
        }

        public function getType() {
            return static::$types[$this->id];
        }
    }