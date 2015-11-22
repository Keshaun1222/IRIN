<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none')
    echo '<h1>Manage Users</h1>';

if ($action == 'none') {
    ?>
    <br /><br />
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Rank</th>
            <th>Name</th>
            <th>Division</th>
            <th>Security Clearance</th>
            <th>Email</th>
        </tr>
        <?php
        foreach (User::getUsers($_SESSION['user'], true) as $user) {
            ?>
            <tr>
                <td>
                    <?php echo $user->getUsername() ?>
                    <?php
                    if (!$user->getAdmin() || $user->getAdmin()->getAdminLevel() < $_SESSION['user']->getAdmin()->getAdminLevel()) {
                        ?>
                        (<a onclick="load('users', 'edit', 'none', {id: '<?php echo $user->getID() ?>'})">Edit</a> || <a onclick="load('users', 'delete', 'none', {id: '<?php echo $user->getID() ?>'})">Delete</a> || <a onclick="load('users', 'switch', 'none', {id: '<?php echo $user->getID() ?>'})">Switch To</a>)
                        <?php
                    }
                    ?>
                </td>
                <td><?php echo $user->getRank()->getName() ?></td>
                <td><?php echo $user->getName() ?></td>
                <td><?php echo $user->getDivision()->getName() ?></td>
                <td><?php echo $user->getClearance()->getClearanceName() ?></td>
                <td><a href="mailto:<?php echo $user->getEmail() ?>"><?php echo $user->getEmail() ?></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <center><a onclick="load('users', 'new', 'none', {})">New User</a></center>
    <?php
} if ($action == 'edit') {
    $user = new User($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $user->getID() ?>" />
            <table>
                <tr>
                    <th>Security Code:</th>
                    <td><a onclick="load('users', 'edit', 'resetpass', {id: '<?php echo $user->getID() ?>'})">Reset</a></td>
                </tr>
                <tr>
                    <th><label for="login">Login ID:</label></th>
                    <td><input type="text" id="login" name="login" value="<?php echo $user->getUsername() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="email">Email Address:</label></th>
                    <td><input type="email" id="email" name="email" value="<?php echo $user->getEmail() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="division">Division:</label></th>
                    <td>
                        <select id="division" name="division">
                            <?php
                            foreach (Division::getAllDivisions() as $division) {
                                if ($user->getDivision()->getDivision() == $division->getDivision())
                                    echo '<option value=' . $division->getDivision() . ' selected>' . $division->getName() . '</option>';
                                else
                                    echo '<option value=' . $division->getDivision() . '>' . $division->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="clearance">Clearance:</label></th>
                    <td>
                        <select id="clearance" name="clearance">
                            <?php
                            foreach (SecurityClearance::getAllClearances() as $val => $clearance) {
                                if ($val != 0) {
                                    if ($user->getClearance()->getClearance() == $val)
                                        echo '<option value=' . $val . ' selected>'. $clearance . '</option>';
                                    else
                                        echo '<option value=' . $val . '>'. $clearance . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="name">Name:</label></th>
                    <td><input type="text" id="name" name="name" value="<?php echo $user->getName() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="rank">Rank:</label></th>
                    <td>
                        <select id="rank" name="rank">
                            <?php
                            foreach (Rank::getRanks($_SESSION['user']) as $rank) {
                                if ($user->getRank()->getRank() == $rank->getRank())
                                    echo '<option value=' . $rank->getRank() . ' selected>' . $rank->getName() . '</option>';
                                else
                                    echo '<option value=' . $rank->getRank() . '>' . $rank->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="divcommand">Division Command Status:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="divcommand" name="divcommand">
                            <?php
                            if ($user->getDivLeader()) {
                                ?>
                                <option value=0>None</option>
                                <option value=1>Division Subleader</option>
                                <option value=2 selected>Division Leader</option>
                                <?php
                            } else if ($user->getSubDivLeader()) {
                                ?>
                                <option value=0>None</option>
                                <option value=1 selected>Division Subleader</option>
                                <option value=2>Division Leader</option>
                                <?php
                            } else {
                                ?>
                                <option value=0 selected>None</option>
                                <option value=1>Division Subleader</option>
                                <option value=2>Division Leader</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editUser()">Edit</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'edit') {
        extract($_POST);
        $subdiv = $div = 0;
        switch($divcommand) {
            case 1:
                $subdiv = 1;
                $div = 0;
                break;
            case 2:
                $subdiv = 1;
                $div = 1;
                break;
        }
        $user->update($login, $email, $division, $clearance, $name, $rank, $div, $subdiv);
    } else if ($do == 'resetpass') {
        $pass = User::createPassword();
        $user->changePassword($pass);

        $to = $user->getEmail();
        $subject = 'IRIN - Password Reset';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: IRIN <DoNotReply@irin.eotir.com>" . "\r\n";

        $message = 'Your password has been reset by an admin.<br /><br /><b>Login ID:</b> ' . $user->getUsername() . '<br /><b>New Password:</b> ' . $pass;

        mail($to, $subject, $message, $headers);
        ?>
        <script>
            load('users', 'none', 'none', {});
        </script>
        <?php
    }
} else if ($action == 'delete') {
    if ($do == 'none') {
        ?>
        <a onclick="load('users', 'delete', 'delete', {id: '<?php echo $_GET['id'] ?>'})">Continue?</a> (<b>NOTE:</b> This action cannot be reversed!)
        <?php
    } else if ($do == 'delete') {
        $user = new User($_GET['id']);
        $user->delete();

        $to = $user->getEmail();
        $subject = 'IRIN - Account Deleted';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: IRIN <DoNotReply@irin.eotir.com>" . "\r\n";

        $message = 'Your account has been deleted by an admin.<br /><br /><b>Login ID:</b> ' . $user->getUsername() . '<br /><b>Name:</b> ' . $user->getName();

        mail($to, $subject, $message, $headers);
        ?>
        <script>
            load('users', 'none', 'none', {});
        </script>
        <?php
    }
} else if ($action == 'new') {
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <th><label for="login">Login ID:</label></th>
                    <td><input type="text" id="login" name="login" required /></td>
                </tr>
                <tr>
                    <th><label for="email">Email Address:</label>&nbsp;&nbsp;</th>
                    <td><input type="email" id="email" name="email" required /></td>
                </tr>
                <tr>
                    <th><label for="division">Division:</label></th>
                    <td>
                        <select id="division" name="division">
                            <?php
                            foreach (Division::getAllDivisions() as $division) {
                                echo '<option value=' . $division->getDivision() . '>' . $division->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="clearance">Clearance:</label></th>
                    <td>
                        <select id="clearance" name="clearance">
                            <?php
                            foreach (SecurityClearance::getAllClearances() as $val => $clearance) {
                                if ($val != 0) {
                                    echo '<option value=' . $val . '>'. $clearance . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="name">Name:</label></th>
                    <td><input type="text" id="name" name="name" required /></td>
                </tr>
                <tr>
                    <th><label for="rank">Rank:</label></th>
                    <td>
                        <select id="rank" name="rank">
                            <?php
                            foreach (Rank::getRanks($_SESSION['user']) as $rank) {
                                echo '<option value=' . $rank->getRank() . '>' . $rank->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="create" name="create" class="btn btn-primary" type="button" onclick="createUser()">Create</button></td>
                </tr>
            </table>
        </form>
        <div id="error" class="alert alert-danger" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'create') {
        extract($_POST);
        if (User::getUserByUsername($login)) {
            echo 'Username already in use.';
        } else if (User::getUserByEmail($email)) {
            echo 'Email address already in use.';
        } else {
            $password = User::createPassword();
            User::create($login, $email, $division, $clearance, $name, $rank, $password);

            $to = $email;
            $subject = 'IRIN - New Account';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: IRIN <DoNotReply@irin.eotir.com>" . "\r\n";

            $message = 'A new account has been created with your email address.<br /><br /><b>Login ID:</b> ' . $login . '<br /><b>New Password:</b> ' . $password . '<br /><b>Name:</b> ' . $name;

            mail($to, $subject, $message, $headers);

            echo 'true';
        }
    }
} else if ($action == 'switch') {
    if (!isset($_SESSION['real']))
        $_SESSION['real'] = $_SESSION['user'];
    $_SESSION['user'] = new User($_GET['id']);
    ?>
    <script>
        window.location = 'main.php';
    </script>
    <?php
}	