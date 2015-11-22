<?php
/* Connect to MySQL DB */
$mysqli = new mysqli($host, $user, $pass, $base);
if (mysqli_connect_errno()) {
    $error = mysqli_connect_error();
    die('Connection failed: ' . $error);
}