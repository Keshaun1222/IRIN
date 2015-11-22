<?php
require_once('lib/path.php');
if (isset($_POST['submit'])) {
    header('Location: index.php');
}

$user = User::login($_POST['username'], $_POST['password']);

if ($user) {
    $_SESSION['user'] = $user;
    echo 'true';
} else {
    echo 'false';
}