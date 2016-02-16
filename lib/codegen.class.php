<?php
class CodeGen {
    private $id;
    private $code;
    private $user;
    private $purpose;
    private $date;

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM codegen WHERE id = $id");
        $result = $query->fetch_array();

        extract($result);
        $this->id = $id;
        $this->code = $code;
        $this->user = new User($user);
        $this->purpose = $purpose;
        $this->date = $date;
    }

    public static function add($code, User $user, $purpose) {
        global $mysqli;

        $insert = $mysqli->query("INSERT INTO codegen VALUES(NULL, '$code', {$user->getID()}, '$purpose', NOW())");
        if (!$insert) {
            throw new DBException('Could not add new approval code.', $mysqli->error);
        }
    }

    /**
     * @return CodeGen[]
     */
    public static function getAll() {
        global $mysqli;

        $codes = array();

        $query = $mysqli->query("SELECT * FROM codegen ORDER BY id DESC");
        while ($result = $query->fetch_array()) {
            $codes[] = new self($result['id']);
        }

        return $codes;
    }

    public static function generateCode(User $user) {
        $rand = rand(100, 999);
        $date = date('mdy');
        $name = strtoupper($user->getName()[0] . $user->getName()[1]);

        $abbrev = '';

        foreach (explode(' ', $user->getAdmin()->getAdminRank()) as $word) {
            $abbrev .= strtoupper($word[0]);
        }

        return $date . $name . $abbrev . $rand;
    }

    public function getID() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPurpose() {
        return $this->purpose;
    }

    public function getDate() {
        return $this->date;
    }
}