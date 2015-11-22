<?php
    class SecurityClearance {
        /**
         * @var int
         */
        private $id;

        /**
         * @var string[]
         */
        private static $clearances = array('None', 'Civilian', 'Epsilon', 'Delta Green', 'Delta Red', 'Alpha Green', 'Alpha Blue', 'Administrator');

        /**
         * @param int $id
         */
        public function __construct($id) {
            $this->id = $id;
        }

        /**
         * @return string[]
         */
        public static function getAllClearances() {
            return static::$clearances;
        }

        /**
         * @return int
         */
        public function getClearance() {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getClearanceName() {
            return static::$clearances[$this->id];
        }
    }