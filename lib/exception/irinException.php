<?php
    class IRINException extends Exception {
        private $toSend;
        private $log = true;

        public function __construct ($message, $previous = null, $log = true) {
            $mess = 'Error: ' . $message;
            parent::__construct($mess, 0, $previous);

            $this->toSend = $message;
            $this->log = $log;
        }

        public function logError(){
            return $this->log;
        }

        public function getSendMessage() {
            return $this->toSend;
        }
    }