<?php

/**
 * Created by PhpStorm.
 * User: Keshaun
 * Date: 8/1/2016
 * Time: 12:28 PM
 */
class MailException extends Exception {
    private $toSend;
    private $log = true;

    public function __construct ($message, $previous = null, $log = true) {
        $mess = 'Mail Error: ' . $message;
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