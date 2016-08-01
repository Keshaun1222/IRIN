<?php
$mail = new PHPMailer();

if ($dev)
    $mail->SMTPDebug = 3;

$mail->isSMTP();
$mail->Host = $smtphost;
$mail->SMTPAuth = true;
$mail->Username = $username;
$mail->Password = $password;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->isHTML(true);