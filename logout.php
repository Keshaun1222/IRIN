<?php
require_once('lib/path.php');
$action = param('action', 'none');

echo '<h1>Logout</h1>';

if ($action == 'none') {
    if (!isset($_SESSION['real'])) {
        ?>
        <center>
            Are you sure you want to logout?<br/>
            <a onclick="load('logout', 'logout', 'none', {})">Yes</a> | <a
                onclick="load('home', 'none', 'none', {})">No</a>
        </center>
        <?php
    } else {
        $_SESSION['user'] = $_SESSION['real'];
        unset($_SESSION['real']);
        ?>
        <script>
            window.location = 'main.php';
        </script>
        <?php
    }
} else if ($action == 'logout') {
    if (isset($_SESSION['user'])) {
        Event::addEvent($_SESSION['user']->getName() . ' has logged out.', $_SESSION['user'], 4);
    } else {
        Event::addEvent('A user\'s session has timed out.', new User(0), 4);
    }
    session_destroy();
    setcookie('user', null, time() - 60*60);
    ?>
    <script>
        window.location = 'index.php';
    </script>
    <?php
}