<?php
class Event {
    private $id;
    private $message;
    private $user;
    private $type;
    private $date;

    //Events: 1=> Addition, 2 => Change, 3 => Deletion

    public function __construct($id){
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM events WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->message = $message;
        $this->user = new User($user);
        $this->type = $type;
        $this->date = $time;
    }

    /**
     * @param int|false $type
     * @return Event[]
     */
    public static function getEvents($type = false) {
        global $mysqli;

        $events = array();
        if ($type) {
            $query = $mysqli->query("SELECT * FROM events WHERE type = $type ORDER BY id DESC");
            while ($result = $query->fetch_array()) {
                $events[] = new self($result['id']);
            }
        } else {
            $query = $mysqli->query("SELECT * FROM events ORDER BY id DESC");
            while ($result = $query->fetch_array()) {
                $events[] = new self($result['id']);
            }
        }

        return $events;
    }

    public static function addEvent($message, User $user, $type) {
        global $mysqli;

        $date = date("Y-m-d H:i:s");
        $mess = $mysqli->real_escape_string($message);
        $mysqli->query("INSERT INTO events VALUES (NULL, '$mess', {$user->getID()} , $type, '$date')");
    }

    public function getID() {
        return $this->id;
    }

    public function getMessage() {
        return stripslashes($this->message);
    }

    public function getUser() {
        return $this->user;
    }

    public function getType() {
        if ($this->type == 1) {
            return 'Addition';
        } else if ($this->type == 2) {
            return 'Change';
        } else {
            return 'Deletion';
        }
    }

    public function getDate() {
        return date('M j, Y g:i:s A', strtotime($this->date));
    }
}