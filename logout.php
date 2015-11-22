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
    session_destroy();
    ?>
    <script>
        window.location = 'index.php';
    </script>
    <?php
}