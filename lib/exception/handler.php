<?php
include '../path.php';
    function exception_handler(Throwable $exception) {
        global $mysqli;
        global $dev;
        global $mail;

        $type = get_class($exception);
        $date = date("Y-m-d H:i:s");
        $tz = date("(T)");
        $to = ($dev ? "keshaun@eotir.com" : 'operations@eotir.com');
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
        } else if ($type == 'IRINException') {
            echo '<span style="color:orange">' . $exception->getSendMessage() . '</span><br />';
            $t = 2;
            $subject = 'IRIN Error';
            $message = 'A user has run into an error.<br /><br />';
            $message .= '<b>Displayed Message:</b> ' . $exception->getSendMessage() . '<br />';
            $message .= '<b>Time:</b> ' . $date . ' ' . $tz . '<br />';
            $message .= 'Notify the Assistant and Lead Administrators immediately.';
        } else if ($type == 'MailException') {
            $t = 4;
            $subject = 'Mail Error';
            $message = 'There was a problem with the sending mail via SMTP.<br /><br />';
            $message .= '<b>Displayed Message:</b> ' . $exception->getSendMessage() . '<br />';
            $message .= '<b>Time:</b> ' . $date . ' ' . $tz . '<br />';
            $message .= 'Please fix this error ASAP.';
        } else {
            $t = 5;
            $subject = 'PHP Error';
            $message = 'There was a PHP error.<br /><br />';
            $message .= '<b>Displayed Message:</b>' . $exception->getMessage() . '<br />';
            $message .= '<b>Time:</b> ' . $date . ' ' . $tz . '<br />';
            $message .= 'Please fix this error ASAP.';
        }

        if ($t != 4) {
            $mail->setFrom('errors@eotir.com', 'Error Handler');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if (!$mail->send()) {
                throw new MailException($mail->ErrorInfo);
            }
        } else {
            mail($to, $subject, $message, $headers);
        }
        $thing = ($t != 5 ? $exception->getSendMessage() : $exception->getMessage());
        $mess = $mysqli->real_escape_string($thing);
        $mysqli->query("INSERT INTO errors VALUES (NULL, '$mess', $t, '$date')");
        ?>
        <table class="table table-striped">
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

function fatal_handler() {
    global $mysqli;
    global $mail;

    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_CORE_ERROR;
    $errline = 0;

    $error = error_get_last();

    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];
        $date = date("Y-m-d H:i:s");

        $mess = $mysqli->real_escape_string($errstr);

        $mysqli->query("INSERT INTO errors VALUES (NULL, '$mess', 3, '$date')");

        $trace = print_r( debug_backtrace( false ), true );

        $errorNo = $mysqli->insert_id;
        $file = $mysqli->real_escape_string($errfile);
        $line = $errline;
        $mysqli->query("INSERT INTO stacktrace VALUES ($errorNo, '$file', $line, NULL, NULL, NULL)");

        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']->getName();
        } else {
            $username = "N/a";
        }
        $content = "
  <table>
  <thead><th>Item</th><th>Description</th></thead>
  <tbody>
  <tr>
    <th>User</th>
    <td><pre>$username</pre></td>
  </tr>
  <tr>
    <th>Error</th>
    <td><pre>$errstr</pre></td>
  </tr>
  <tr>
    <th>Errno</th>
    <td><pre>$errno</pre></td>
  </tr>
  <tr>
    <th>File</th>
    <td>$errfile</td>
  </tr>
  <tr>
    <th>Line</th>
    <td>$errline</td>
  </tr>
  <tr>
    <th>Trace</th>
    <td><pre>$trace</pre></td>
  </tr>
  </tbody>
  </table>";

        $to = "keshaun@eotir.com";
        $subject = "Fatal Error";
        $headers = "MIME-Version: 1.0" . "\r\n";
        /*$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: Error Handler <errors@eotir.com>" . "\r\n";*/

        //mail($to, $subject, $content, $headers);
        $mail->setFrom('errors@eotir.com', 'Error Handler');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $content;

        if (!$mail->send()) {
            throw new MailException($mail->ErrorInfo);
        }

        //error_mail(format_error($errno, $errstr, $errfile, $errline));
    }
}

function format_error( $errno, $errstr, $errfile, $errline ) {


    return $content;
}

function error_mail($content) {
    $date = date("Y-m-d H:i:s");
    $tz = date("(T)");
    $to = "keshaun@eotir.com";
    $subject = "Fatal Error";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: Error Handler <errors@eotir.com>" . "\r\n";
    //mail($to, $subject, $content, $headers);
}