<?php
require_once('lib/path.php');
$action = param('action');
$do = param('do');
if ($action == 'none') {
    ?>
    <h1>User Information</h1>
    <b>Login ID:</b> <?php echo $_SESSION['user']->getUsername() ?><br/>
    <b>Name:</b> <?php echo $_SESSION['user']->getName() ?><br/>
    <b>Clearance:</b> <?php echo $_SESSION['user']->getClearance()->getClearanceName() ?><br/>
    <b>Rank:</b> <?php echo $_SESSION['user']->getRank()->getName() ?><br/>
    <a onclick="load('info', 'pass', 'form', {})">Change Your Security Code</a>
    <?php
} else if ($action == 'pass') {
    if ($do == 'form') {
        ?>
        <h1>User Information</h1>
        <form action="#" method="post">
            <table>
                <tr>
                    <td><label for="password">Old Security Code</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Old Security Code" required autofocus /></td>
                </tr>
                <tr>
                    <td><label for="confpass1">New Security Code</label></td>
                    <td><input type="password" id="confpass1" name="confpass1" placeholder="New Security Code" required /></td>
                </tr>
                <tr>
                    <td><label for="confpass2">Re-Enter Security Code</label>&nbsp;&nbsp;</td>
                    <td><input type="password" id="confpass2" name="confpass2" placeholder="Re-Enter Security Code" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="submit" name="submit" class="btn btn-primary" type="button" onclick="changePassword();">Change</button></td>
                </tr>
            </table>
        </form>
        <div id="error" class="alert alert-danger" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'change') {
        if ($_POST['confpass1'] != $_POST['confpass2']) {
            echo 'The new security codes do not match!';
        } else if (!User::login($_SESSION['user']->getUsername(), $_POST['password'])) {
            echo 'The old security code is incorrect!';
        } else {
            $_SESSION['user']->changePassword($_POST['confpass1']);
            echo 'true';
        }
    }
}