<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none')
    echo '<h1>Merit System Database</h1>';

if (!$_SESSION['user']->isDivCommand() && !$_SESSION['user']->getAdmin() && !$_SESSION['user']->isThrone()) {
    echo 'You do not have access to this section.';
} else {
    if ($action == 'none' || $action == 'view') {
        ?>
        <table class="table table-hover">
            <?php
            if ($_SESSION['user']->getAdmin() || $_SESSION['user']->isThrone()) {
                $users = User::getUsers($_SESSION['user']);
                ?>
                <tr>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Clearance</th>
                    <th>Division</th>
                    <th>Merits</th>
                    <th>Option(s)</th>
                </tr>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->getName() ?></td>
                        <td><?php echo $user->getRank()->getName() ?></td>
                        <td><?php echo $user->getClearance()->getClearanceName() ?></td>
                        <td><?php echo $user->getDivision()->getName() ?></td>
                        <td><?php echo $user->getMerits() ?></td>
                        <td>
                            <?php
                            if (!$user->getAdmin() && !$user->isThrone()) {
                                ?>
                                <a onclick="load('meritdb', 'edit', 'none', {id: '<?php echo $user->getID() ?>'})">Edit</a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                $users = User::getDivUsers($_SESSION['user']->getDivision());

                if ($_SESSION['user']->getDivision()->hasSubDivisions()) {
                    foreach($_SESSION['user']->getDivision()->getSubDivisions() as $division) {
                        foreach (User::getDivUsers($division) as $user) {
                            $users[] = $user;
                        }
                        if ($division->hasSubDivisions()) {
                            foreach ($division->getSubDivisions() as $div) {
                                foreach (User::getDivUsers($div) as $user) {
                                    $users[] = $user;
                                }
                            }
                        }
                    }
                }
                ?>
                <tr>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Clearance</th>
                    <th>Merits</th>
                    <th>Option(s)</th>
                </tr>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->getName() ?></td>
                        <td><?php echo $user->getRank()->getName() ?></td>
                        <td><?php echo $user->getClearance()->getClearanceName() ?></td>
                        <td><?php echo $user->getMerits() ?></td>
                        <td>
                            <?php
                            if (!($user->getDivision()->getDivision() == $_SESSION['user']->getDivision()->getDivision() && $user->getDivLeader()) && $_SESSION['user']->getID() != $user->getID()) {
                                ?>
                                <a onclick="load('meritdb', 'edit', 'none', {id: '<?php echo $user->getID() ?>'})">Edit</a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php
    } else if ($action == 'edit') {
        $user = new User($_GET['id']);
        if ($do == 'none') {
            ?>
            <form action=#" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $user->getID() ?>" />
                <table>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $user->getName() ?></td>
                    </tr>
                    <tr>
                        <th>Rank:</th>
                        <td><?php echo $user->getRank()->getName() ?></td>
                    </tr>
                    <tr>
                        <th>Clearance:&nbsp;&nbsp;</th>
                        <td><?php echo $user->getClearance()->getClearanceName() ?></td>
                    </tr>
                    <tr>
                        <th><label for="merits">Merits</label></th>
                        <td><input type="number" id="merits" name="merits" value="<?php echo $user->getMerits() ?>" required /></td>
                    </tr>
                    <tr>
                        <td colspan=2><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editMerits()">Edit</button></td>
                    </tr>
                </table>
            </form>
            <div id="loading" class="alert alert-info" role="alert" style="display: none">

            </div>
            <?php
        } else if ($do == 'edit') {
            extract($_POST);
            $user->changeMerits($merits);
        }
    }
}	