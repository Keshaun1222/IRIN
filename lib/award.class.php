<?php
class Award {
    private $id;
    private $name;
    private $abbrev;
    private $ribbon;
    private $medal;
    private $max;
    private $division;

    public function __construct($id, $num = NULL, $full = true) {
        global $mysqli;
        global $awardLink;

        $query = $mysqli->query("SELECT * FROM awardslist WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);
        $this->id = $id;
        $this->name = $name;
        $this->abbrev = $abbrev;

        if ($multi == 1) {
            if ($num == NULL) $num = 1;
            if ($full) {
                if ($num <= $max || $num == "Half") {
                    $this->name .= ' x' . $num;
                    $this->abbrev .= '-' . $num;
                } else {
                    $this->name .= ' x' . $max;
                    $this->abbrev .= '-' . $max;
                }
            }
        }

        $this->max = $max;
        $this->ribbon = $awardLink . 'ribbons/' . $this->abbrev .'.gif';
        $this->medal = $awardLink . 'medals/' . $this->abbrev .'.png';
//        $this->division = new Division($division);
    }

    /**
     * @return Award[]
     */
    public static function getAllAwards() {
        global $mysqli;

        $awards = array();

        $query = $mysqli->query("SELECT * FROM awardslist");
        while ($result = $query->fetch_array()) {
            $awards[] = new self($result['id']);
        }

        return $awards;
    }

    public static function getAll() {
        global $mysqli;

        $awards = array();

        $query = $mysqli->query("SELECT * FROM awardslist");
        while ($result = $query->fetch_array()) {
            $awards[] = new self($result['id'], NULL, false);
        }

        return $awards;
    }

    /**
     * @param $user
     * @return Award[]
     */
    public static function getUserAwards(User $user) {
        global $mysqli;

        $i = 0;

        $query = $mysqli->query("SELECT * FROM awards WHERE userid = {$user->getID()}");
        $result = $query->fetch_array();

        $list = array();

        if ($result['awards'] != '') {
            $awards = explode(',', $result['awards']);
            if ($result['multi'] != '') {
                $multi = explode(',', $result['multi']);
            }

            foreach($awards as $award) {
                if (self::isMulti($award)) {
                    $list[] = new Award($award, $multi[$i]);
                    $i++;
                } else {
                    $list[] = new Award($award);
                }
            }
        }

        return $list;
    }

    public static function hasAward(User $user, Award $award, $exact = false) {
        foreach ($user->getAwards() as $test) {
            if ($exact) {
                if ($test == $award)
                    return true;
            } else {
                if ($test->isSame($award))
                    return true;
            }
        }
        return false;
    }

    public static function isMulti($award) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM awardslist WHERE id = $award");
        $result = $query->fetch_array();

        if ($result['multi'] == 1)
            return true;
        return false;
    }

    public static function updateUserAwards(User $user, $awards, $multi) {
        global $mysqli;

        $update = $mysqli->query("UPDATE awards SET awards = '$awards', multi = '$multi' WHERE userid = {$user->getID()}");
        if (!$update) {
            throw new DBException('Could not update this user\'s awards.', $mysqli->error);
        }
    }

    public function getAward() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAbbrev() {
        return $this->abbrev;
    }

    public function getRibbon() {
        return $this->ribbon;
    }

    public function getMedal() {
        return $this->medal;
    }

    public function getMax() {
        return $this->max;
    }

    public function getDivision() {
        return $this->division;
    }

    public function isSame(Award $award) {
        if ($this->id == $award->getAward())
            return true;
        return false;
    }
}