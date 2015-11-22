<?php

class DevWorklog {
    private $id;
    private $pcr;
    private $text;
    private $assigned = false;
    private $status;
    private $date;

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM worklog WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);

        $this->id = $id;
        $this->text = stripslashes($log);
        $this->status = $status;
        $this->date = $date;

        if ($minorPCR != NULL) {
            $this->pcr = $pcrNum . '.' . $minorPCR;
        } else {
            $this->pcr = $pcrNum;
        }

        if ($assigned != NULL) {
            $this->assigned = new User($assigned);
        }
    }

    /**
     * @return DevWorklog[]
     */
    public static function getAllWorklog() {
        global $mysqli;

        $log = array();

        $query = $mysqli->query("SELECT * FROM worklog");
        while ($result = $query->fetch_array()) {
            $log[] = new self($result['id']);
        }

        return $log;
    }

    public static function getLatestWorklog() {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM worklog ORDER BY id DESC LIMIT 1");
        $result = $query->fetch_array();

        return new self($result['id']);
    }

    public static function create($text, $pcr, $minorPCR = NULL) {
        global $mysqli;

        $text = $mysqli->real_escape_string($text);

        if ($minorPCR != NULL)
            $insert = $mysqli->query("INSERT INTO worklog VALUES (NULL, '$text', 1, $pcr, $minorPCR, NULL, NULL)");
        else
            $insert = $mysqli->query("INSERT INTO worklog VALUES (NULL, '$text', 1, $pcr, NULL, NULL, NULL)");

        if (!$insert) {
            throw new DBException('Could not create a new PCR', $mysqli->error);
        }
    }

    public function getID() {
        return $this->id;
    }

    public function getPCR() {
        return $this->pcr;
    }

    public function getPCRNum() {
        return explode('.', $this->pcr)[0];
    }

    public function getMinorPCR() {
        if (count(explode('.', $this->pcr)) == 1)
            return null;
        return explode('.', $this->pcr)[1];
    }

    public function getText() {
        return $this->text;
    }

    public function isInProgress() {
        return $this->status == 1;
    }

    public function getAssigned() {
        return $this->assigned;
    }

    public function assign(User $user) {
        global $mysqli;

        $assigned = $user;
        $this->assigned = $assigned;

        $update = $mysqli->query("UPDATE worklog SET assigned = {$assigned->getID()} WHERE id = $this->id");
        if (!$update) {
            throw new DBException('Could not assign the user to this PCR.', $mysqli->error);
        }
    }

    public function cancel() {
        global $mysqli;

        $this->status = 0;

        $update = $mysqli->query("UPDATE worklog SET status = 0 WHERE id = $this->id");
        if (!$update) {
            throw new DBException('Could not change the status of this PCR.', $mysqli->error);
        }
    }

    public function complete() {
        global $mysqli;

        $date = date('n/j/y');
        $this->date = $date;
        $this->status = 2;

        $update = $mysqli->query("UPDATE worklog SET date = '$date', status = 2 WHERE id = $this->id");
        if (!$update) {
            throw new DBException('Could not change the status of this PCR.', $mysqli->error);
        }
    }

    public function update($text, $pcr, $minorPCR = NULL) {
        global $mysqli;

        $text = $mysqli->real_escape_string($text);

        if ($minorPCR != NULL)
            $update = $mysqli->query("UPDATE worklog SET log = '$text', pcrNum = $pcr, minorPCR = $minorPCR WHERE id = {$this->id}");
        else
            $update = $mysqli->query("UPDATE worklog SET log = '$text', pcrNum = $pcr, minorPCR = NULL WHERE id = {$this->id}");

        if (!$update) {
            throw new DBException('Could not update PCR', $mysqli->error);
        }
    }

    public function __toString() {
        switch ($this->status) {
            case 1:
                $statusText = '<b style="color:orange">In Progress</b>';
                break;
            case 2:
                $statusText = '<b style="color:green">Completed - ' . $this->date . '</b>';
                break;
            default:
                $statusText = '<b style="color:red">Cancelled</b>';
                break;
        }

        $assignedText = '';
        if ($this->assigned) {
            $assignedText = 'Assigned to ' . $this->assigned->getName() . ' ';
        }

        return '<b>PCR-' . $this->pcr . '</b> - ' . $this->text . ' <b>' . $assignedText . '</b> - ' . $statusText;
    }
}