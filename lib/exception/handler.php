<?php
    function exception_handler(Exception $exception) {
        global $mysqli;

        $type = get_class($exception);
        $date = date("Y-m-d H:i:s");
        $tz = date("(T)");
        $to = "keshaun@eotir.com";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: Error Handler <errors@eotir.com>" . "\r\n";

        if ($type == 'DBException') {
            echo '<span style="color:red">' . $exception->getMessage() . '</span><br />';
            $t = 1;
            $subject = 'Database Error';
            $message = 'An Database error has occurred.<br /><br />';
            $message .= '<b>Error Message:</b> ' . $exception->getSendMessage() . '<br />';
            $message .= '<b>Time:</b> ' . $date . ' ' . $tz . '<br />';
            $message .= 'Please fix this error ASAP.';
        } else {
            echo '<span style="color:orange">' . $exception->getMessage() . '</span><br />';
            $t = 2;
            $subject = 'IRIN Error';
            $message = 'A user has run into an error.<br /><br />';
            $message .= '<b>Displayed Message:</b> ' . $exception->getSendMessage() . '<br />';
            $message .= '<b>Time:</b> ' . $date . ' ' . $tz . '<br />';
            $message .= 'Notify the Assistant and Lead Administrators immediately.';
        }

        mail($to, $subject, $message, $headers);
        $mess = $mysqli->real_escape_string($exception->getSendMessage());
        $mysqli->query("INSERT INTO errors VALUES (NULL, '$mess', $t, '$date')");
        ?>
        <table>
            <tr>
                <th>Class</th>
                <th>Function</th>
                <th>Arguments</th>
                <th>File</th>
            </tr>
        <?php
        $errorNo = $mysqli->insert_id;
        foreach($exception->getTrace() as $trace) {
            $file = $mysqli->real_escape_string($trace['file']);
            $line = $trace['line'];
            $class = NULL;
            $function = NULL;
            $args = NULL;
            if (isset($trace['class'])) {
                $class = $trace['class'];
            }
            if (isset($trace['function'])) {
                $function = $trace['function'];
            }
            if (!empty($trace['args'])) {
                $args = implode(", ", $trace['args']);
            }
            $mysqli->query("INSERT INTO stacktrace VALUES ($errorNo, '$file', $line, '$class', '$function', '$args')");
            ?>
            <tr>
                <td><?php echo $class; ?></td>
                <td><?php echo $function; ?></td>
                <td><?php echo '(' . $args . ')'; ?></td>
                <td><?php echo '(' . stripslashes($file) . ':' . $line . ')'; ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
<?php
    }