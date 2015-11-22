<?php
    class DocPrefix {
        private $id;

        private static $prefixes = array(
            array('name' => 'None', 'abbrev' => ''),
            array('name' => 'Supreme Command', 'abbrev' => 'C'),
            array('name' => 'Executive Order', 'abbrev' => 'E'),
            array('name' => 'Defense', 'abbrev' => 'D'),
            array('name' => 'Intelligence', 'abbrev' => 'I'),
            array('name' => 'Security', 'abbrev' => 'S'),
            array('name' => 'Government', 'abbrev' => 'G'),
            array('name' => 'Financial', 'abbrev' => 'F'),
            array('name' => 'Business', 'abbrev' => 'B'),
            array('name' => 'Private', 'abbrev' => 'P')
        );

        public function __construct($id) {
            $this->id = $id;
        }

        public static function getAllPrefixes() {
            return static::$prefixes;
        }

        public function getPrefix() {
            return $this->id;
        }

        public function getPrefixName() {
            $prefix = static::$prefixes[$this->id];
            return $prefix['name'];
        }

        public function getPrefixAbbrev() {
            $prefix = static::$prefixes[$this->id];
            return $prefix['abbrev'];
        }
    }