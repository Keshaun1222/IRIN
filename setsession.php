<?php
require_once('lib/path.php');

//$_SESSION['lastactive'] = $_GET['time'];
if (!isset($_SESSION['user'])) {
    if (!isset($_COOKIE['user'])) {
        //setcookie('page', $_GET['page'], time() + 60*30);
        echo 'false';
    } else {
        $_SESSION['user'] = User::getUserByUsername($_COOKIE['user']);
        echo 'true';
    }
} else {
    echo 'true';
}