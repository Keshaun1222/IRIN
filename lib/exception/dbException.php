<?php
    class DBException extends Exception {
        private $toSend;
        private $log = true;

        public function __construct ($message, $error, $previous = null, $log = true) {
            $mess = 'Database Error: ' . $message . ' Try again later.';
            parent::__construct($mess, 0, $previous);

            $this->toSend = $error;
            $this->log = $log;
        }

        public function logError(){
            return $this->log;
        }

        public function getSendMessage() {
            return $this->toSend;
        }
    }