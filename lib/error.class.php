<?php
    class Error {
        private $id;
        private $message;
        private $type;
        private $date;
        private $stack = array();

        public function __construct($id) {
            global $mysqli;

            $query = $mysqli->query("SELECT * FROM errors WHERE id = $id");
            $result = $query->fetch_array();

            extract($result);

            $this->id = $id;
            $this->message = $message;
            $this->type = $type;
            $this->date = $time;

            $q = $mysqli->query("SELECT * FROM stacktrace WHERE errorNo = $id");
            while($r = $q->fetch_array()) {
                $trace = array();
                $trace['file'] = $r['file'];
                $trace['line'] = $r['line'];
                $trace['class'] = $r['class'];
                $trace['function'] = $r['function'];
                $trace['args'] = explode(', ', $r['args']);
                $this->stack[] = $trace;
            }
        }

        /**
         * @param int|false $type
         * @return Error[]
         */
        public static function getErrors($type = false) {
            global $mysqli;

            $errors = array();
            if ($type) {
                $query = $mysqli->query("SELECT * FROM errors WHERE type = $type ORDER BY id DESC");
                while ($result = $query->fetch_array()) {
                    $errors[] = new self($result['id']);
                }
            } else {
                $query = $mysqli->query("SELECT * FROM errors ORDER BY id DESC");
                while ($result = $query->fetch_array()) {
                    $errors[] = new self($result['id']);
                }
            }

            return $errors;
        }

        public function getID() {
            return $this->id;
        }

        public function getMessage() {
            return stripslashes($this->message);
        }

        public function getDate() {
            return date('M j, Y g:i:s A', strtotime($this->date));
        }

        public function getType() {
            if ($this->type == 1) {
                return 'DBException';
            } else if ($this->type == 2) {
                return 'IRINException';
            } else {
                return 'FatalError';
            }
        }

        public function getStackTrace() {
            return $this->stack;
        }

        public function printStackTrace() {
            $text = <<<Stack
<table class="table table-hover">
    <tr>
        <th>Class</th>
        <th>Function</th>
        <th>Arguments</th>
        <th>File</th>
    </tr>
Stack;
            foreach ($this->stack as $stack) {
                $file = $stack['file'];
                $line = $stack['line'];
                $class = NULL;
                $function = NULL;
                $args = NULL;

                if (isset($stack['class'])) {
                    $class = $stack['class'];
                }
                if (isset($stack['function'])) {
                    $function = $stack['function'];
                }
                if (!empty($stack['args'])) {
                    $args = implode(", ", $stack['args']);
                }

                $text .= <<<Trace
<tr>
    <td>{$class}</td>
    <td>{$function}</td>
    <td>({$args})</td>
    <td>({$file}:{$line})</td>
</tr>
Trace;

            }
            $text .= '</table>';

            return $text;
        }
    }