<?php
    class Document {
        private $id;
        private $title;
        private $content;
        private $clearance;
        private $creator;
        private $status;
        private $type;
        private $prefix;
        /**
         * @var User[]
         */
        private $signers = array();
        /**
         * @var User[]
         */
        private $assignees = array();
        private $date;

        /**
         * The Constructor for the Documents Class. Queries the database and assigns values to the approriate variables.
         * @param integer $id
         */
        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM documents WHERE id = $id");
            $result = $query->fetch_array();

            extract($result);

            $this->id = $id;
            $this->title = $subject;
            $this->content = $text;
            $this->date = $date;

            $this->clearance = new SecurityClearance($clearance);

            $this->creator = new User($creator);

            $this->status = new DocStatus($status);

            //TODO Make a document type class
            //TODO Ask Ryan what the Document Type was originally used for
            //$this->type = new DocType($type);

            $this->prefix = new DocPrefix($prefix);

            $signers = explode(',', $signed);
            for ($i = 0; $i < count($signers); $i++) {
                $this->signers[] = new User($signers[$i]);
            }
			
			if ($assignees != '') {
				$assignee = explode(',', $assignees);
				for ($i = 0; $i < count($assignee); $i++) {
					$this->assignees[] = new User($assignee[$i]);
				}
			}
        }

        /**
         * Find a Document. If the provided id couldn't be found, return false. Otherwise, return the document (if the user has proper access).
         * @param int $id
         * @param User $user
         * @return boolean|Document
         */
        public static function find($id, User $user) {
            global $mysqli;

            $query = $mysqli->query("SELECT id FROM documents WHERE id = $id");

            if (self::doesExist($id)) {
                $result = $query->fetch_array();
                $doc = new self($result['id']);
                if ($user->getAdmin() || $user->isThrone() || $doc->isCreator($user) || $doc->isAssigned($user) || $doc->checkClearance($user)) {
                    return $doc;
                }
            }
            return false;
        }

        public static function doesExist($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT id FROM documents WHERE id = $id");

            if ($query->num_rows == 0) {
                return false;
            }

            return true;
        }

        /**
         * Get Documents. Only return documents that the user has access to (i.e. They've either made the document, been assigned to the document, or they're either an Admin or a member of the Throne.)
         * @param User $user
         * @return Document[]
         */
        public static function getDocuments(User $user) {
            global $mysqli;

            $docs = array();

            $query = $mysqli->query("SELECT id FROM documents ORDER BY date DESC");
            while($result = $query->fetch_array()) {
                $doc = new self($result['id']);
                if ($user->getAdmin() || $user->isThrone() || $doc->isCreator($user) || $doc->isAssigned($user)) {
                    $docs[] = $doc;
                }
            }

            return $docs;
        }

        public static function generateID() {
            global $mysqli;

            $str = '';
            for ($i = 0; $i < 6; $i++) {
                $str .= rand(0, 9);
            }

            $check = $mysqli->query("SELECT * FROM documents WHERE id = $str");
            if ($check->num_rows > 0)
                return self::generateID();
            return $str;
        }

        public static function create($subject, $text, $clearance, $prefix, $creator, $assignees) {
            global $mysqli;

            $id = self::generateID();
            $subject = addslashes(stripslashes(stripslashes($subject)));
            $body = addslashes(stripslashes(strip_tags($text)));
			
			if ($assignees == '') {
				$assignees = '0';
			}

            $insert = $mysqli->query("INSERT INTO documents VALUES ($id, '$subject', '$body', $clearance, $creator, 4, 0, $prefix, '$creator', '$assignees', NOW())");
            if (!$insert) {
                throw new DBException('Could not create new document/order.', $mysqli->error);
            }

            return new self($id);
        }

        public function getID() {
            return $this->id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getContent() {
            return $this->content;
        }

        public function getClearance() {
            return $this->clearance;
        }

        /**
         * @return User
         */
        public function getCreator() {
            return $this->creator;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getPrefix() {
            return $this->prefix;
        }

        public function getSigners() {
            return $this->signers;
        }

        public function getAssignees() {
            return $this->assignees;
        }

        public function getDate() {
            return $this->date;
        }

        /**
         * Check if the user created the document.
         * @param User $user
         * @return boolean
         */
        public function isCreator(User $user) {
            if ($user == $this->creator) {
                return true;
            }

            return false;
        }

        /**
         * Check if the user has been assigned to the document.
         * @param User $user
         * @return boolean
         */
        public function isAssigned(User $user) {
            foreach ($this->assignees as $assignee) {
                if ($user == $assignee) {
                    return true;
                }
            }

            return false;
        }

        /**
         * Check if the user has the proper clearance to view the document.
         * @param User $user
         * @return boolean
         */
        public function checkClearance(User $user) {
            if ($this->clearance->getClearance() > $user->getClearance()->getClearance())
                return false;
            return true;
        }

        /**
         * Allows a user to sign the document.
         * @param User $user
         * @throws DBException
         */
        public function sign(User $user) {
            global $mysqli;

            $this->signers[] = $user;

            $signers = array();

            foreach ($this->signers as $signer) {
                $signers[] = $signer->getID();
            }

            $string = implode(',', $signers);

            $insert = $mysqli->query("UPDATE documents SET signed = '$string' WHERE id = {$this->id}");
            if (!$insert) {
                throw new DBException('Unable to update signers for this document.', $mysqli->error);
            }
        }

        public function addAssignee(User $user) {
            global $mysqli;

            $this->assignees[] = $user;

            $assignees = array();

            foreach ($this->assignees as $assignee) {
                $assignees[] = $assignee->getID();
            }

            $string = implode(',', $assignee);

            $insert = $mysqli->query("UPDATE documents SET assignees = '$string' WHERE id = {$this->id}");
            if (!$insert) {
                throw new DBException('Unable to update assignees for this document.', $mysqli->error);
            }
        }

        public function update($subject, $status, $text, $clearance, $prefix, $assignees) {
            global $mysqli;

            $subject = addslashes(stripslashes(stripslashes($subject)));
            $body = addslashes(stripslashes(strip_tags($text)));

            $update = $mysqli->query("UPDATE documents SET subject = '$subject', status = $status, text = '$body', assignees = '$assignees', date = NOW(), clearance = $clearance, prefix = $prefix WHERE id = {$this->id}");
            if (!$update) {
                throw new DBException('Could not update document/order.', $mysqli->error);
            }
        }

        public function delete() {
            global $mysqli;

            $delete = $mysqli->query("DELETE FROM documents WHERE id = {$this->id}");
            if (!$delete) {
                throw new DBException('Could not delete document/order.', $mysqli->error);
            }
        }
    }