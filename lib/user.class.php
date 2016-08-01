<?php
    class User {
        private $id;
        private $username;
        private $name;
        private $email;
        private $rank;
        private $merits;
        private $leader = false;
        private $subleader = false;
        private $division;
        private $sc;
        private $admin = false;
        private $awards = array();
        /*private $nominator = false;
        private $approver = false;*/

        /**
         * The Constructor for the User class. Queries the database and assigns values to the approriate variables.
         * @param integer $id
         * @throws DBException
         */
        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM users WHERE id = $id");
            if (!$query)
                throw new DBException('Can\'t get user.', $mysqli->error);
            $result = $query->fetch_array();

            extract($result);
            $this->id = $id;
            $this->username = $username;
            $this->name = $name;
            $this->email = $email;
            $this->merits = $merits;

            $this->rank = new Rank($rank);

            $this->leader = ($divleader == 1);
            $this->subleader = ($subdivleader == 1);

            $this->division = new Division($division);
            $this->sc = new SecurityClearance($clearance);

            if ($clearance == 7 || $admin != 0) {
                $this->admin = new Admin($id);
            }

            /*if ($nominator == 1)
                $this->nominator = true;
            if ($approver == 1)
                $this->approver = true;*/

            $this->awards = Award::getUserAwards($this);

            /*if ($clearance <= 6) {
                $this->division = new Division($div);
                $this->sc = new SecurityClearance($clearance);
            } else {
                $this->admin = new Admin($clearance, $div);
            }*/
        }

        /**
         * Login to IRIN. If the user provides an invalid username/password combination, the function returns false. Otherwise, it returns an user object.
         * @param string $user
         * @param string $password
         * @return boolean|User
         */
        public static function login($user, $password) {
            global $mysqli;

            $pass = md5($password);
            $query = $mysqli->query("SELECT id FROM users WHERE username = '$user' AND password = '$pass'");
            $count = $query->num_rows;

            if ($count == 0) {
                return false;
            } else {
                $result = $query->fetch_array();
                User::lastLogin($result['id']);
                return new self($result['id']);
            }
        }

        public static function lastLogin($id) {
            global $mysqli;

            $ip = $_SERVER['REMOTE_ADDR'];
            $date = date("Y-m-d H:i:s");
            $update = $mysqli->query("UPDATE users SET lastlogin = '$date', ip = '$ip' WHERE id = $id");
        }

        public static function getUserByUsername($username) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
            if ($query->num_rows > 0) {
                $result = $query->fetch_array();
                return new self($result['id']);
            }
            return false;
        }

        public static function getUserByEmail($email) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
            if ($query->num_rows > 0) {
                $result = $query->fetch_array();
                return new self($result['id']);
            }
            return false;
        }

        /**
         * @param User $user
         * @param bool $override
         * @return User[]
         */
        public static function getUsers(User $user, $override = false) {
            global $mysqli;

            $users = array();

            $query = $mysqli->query("SELECT * FROM users ORDER BY id");
            while ($result = $query->fetch_array()) {
                $other = new User($result['id']);
                if ($other->getID() != 0 && (($user->getAdmin() && $other->getAdmin() && $user->getAdmin()->getAdminLevel() >= $other->getAdmin()->getAdminLevel()) || ($user->getClearance()->getClearance() >= $other->getClearance()->getClearance()))) {
                    $users[] = $other;
                } else if ($override && $other->getID() != 0) {
                    $users[] = $other;
                }
            }

            return $users;
        }

        /**
         * @param Division $div
         * @param User $user
         * @return User[]
         */
        public static function getTeamUsers(Division $div, User $user) {
            global $mysqli;

            $users = array();

            $query = $mysqli->query("SELECT * FROM users INNER JOIN admin ON users.id = admin.userid WHERE users.id <> 0 AND (users.division = {$div->getDivision()} OR users.division = 0 OR admin.teams LIKE '%{$div->getDivision()}%') ORDER BY users.id");
            while ($result = $query->fetch_array()) {
                $other = new User($result['id']);
                if ($other->getAdmin()->getAdminLevel() <= $user->getAdmin()->getAdminLevel()) {
                    $users[] = $other;
                }
            }

            return $users;
        }

        /**
         * @param Division $div
         * @return User[]
         */
        public static function getDivUsers(Division $div) {
            global $mysqli;

            $users = array();

            $query = $mysqli->query("SELECT * FROM users WHERE division = {$div->getDivision()} ORDER BY id");
            while ($result = $query->fetch_array()) {
                $other = new User($result['id']);
                $users[] = $other;
            }

            return $users;
        }

        public static function createPassword()
        {
            $feed = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $str = '';

            for ($i = 0; $i < 8; $i++) {
                $str .= substr($feed, rand(0, strlen($feed) - 1), 1);
            }

            return $str;
        }

        public static function create($username, $email, $division, $clearance, $name, $rank, $password) {
            global $mysqli;

            $pass = md5($password);

            $insert = $mysqli->query("INSERT INTO users VALUE (NULL, '$username', '$pass', '$email', $rank, '', '0000-00-00 00:00:00', '$name', $clearance, $division, 0, 0, 0, 0, 0)");
            if (!$insert) {
                throw new DBException('Could not create user.', $mysqli->error);
            }

            $id = $mysqli->insert_id;

            $insert = $mysqli->query("INSERT INTO awards VALUE ($id, '', '')");
			
			if ($clearance == 7) {
				Admin::create($id, 1, 0);
			}
        }

        /**
         * Change the user's password.
         * @param string $password
         * @throws DBException
         */
        public function changePassword($password) {
            global $mysqli;

            $pass = md5($password);
            $update = $mysqli->query("UPDATE users SET password = '$pass' WHERE id = $this->id");

            if (!$update) {
                throw new DBException('Could not change password.', $mysqli->error);
            }
        }

        public function getID() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getRank() {
            return $this->rank;
        }

        public function getDivision() {
            if ($this->admin && $this->sc->getClearance() == 7) {
                return $this->admin->getPrimaryTeam();
            }
            else {
                return $this->division;
            }
        }

        public function getClearance() {
            return $this->sc;
        }

        public function getMerits() {
            return $this->merits;
        }

        /**
         * Get the user's admin value. Either returns a boolean value (of false) or an Admin object.
         * @return boolean|Admin
         */
        public function getAdmin() {
            return $this->admin;
        }

        public function getDivLeader() {
            return $this->leader;
        }

        public function getSubDivLeader() {
            return $this->subleader;
        }

        /**
         * @return Award[]
         */
        public function getAwards() {
            return $this->awards;
        }

        /*public function getNominator() {
            return $this->nominator;
        }

        public function getApprover() {
            return $this->approver;
        }*/

        public function isThrone() {
            if ($this->sc->getClearance() >= 5 && $this->division->getDivision() == 6) {
                return true;
            }
            return false;
        }

        public function isDivCommand() {
            if ($this->leader || $this->subleader) {
                return true;
            }
            return false;
        }

        public function changeDivision(Division $division) {
            global $mysqli;

            $update = $mysqli->query("UPDATE users SET div = {$division->getDivision()} WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update division.', $mysqli->error);
            }
        }

        public function update($username, $email, $division, $clearance, $name, $rank, $divleader, $subdivleader) {
            global $mysqli;

            $update = $mysqli->query("UPDATE users SET username = '$username', email = '$email', rank = $rank, name = '$name', clearance = $clearance, division = $division, divleader = $divleader, subdivleader = $subdivleader WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update user.', $mysqli->error);
            }
        }

        public function changeMerits($merits) {
            global $mysqli;

            $update = $mysqli->query("UPDATE users SET merits = $merits WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update this user\'s merits.', $mysqli->error);
            }
        }

        public function delete() {
            global $mysqli;
            $delete = $mysqli->query("DELETE FROM users WHERE id = {$this->id}");
            if (!$delete) {
                throw new DBException('Could not delete user.', $mysqli->error);
            }
        }
    }