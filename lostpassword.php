<?php
require_once('lib/path.php');
if (isset($_POST['submit'])) {
    header('Location: lostpass.php');
}

$user = User::getUserByEmail($_POST['email']);

if ($user) {
    $pass = User::createPassword();
    $user->changePassword($pass);

    $to = $_POST['email'];
    $subject = 'IRIN - Password Reset';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: IRIN <DoNotReply@irin.eotir.com>" . "\r\n";

    $message = 'You have requested a new password.<br /><br /><b>Login ID:</b> ' . $user->getUsername() . '<br /><b>New Password:</b> ' . $pass;

    //mail($to, $subject, $message, $headers);
    $mail->setFrom('DoNotReply@eotir.com', 'IRIN');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->send()) {
        throw new MailException($mail->ErrorInfo);
    }

    echo 'true';
} else {
    echo 'false';
}