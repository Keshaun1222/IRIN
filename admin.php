<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none')
    echo '<h1>Administrative Staff Editor</h1>';

if ($action == 'none') {
    ?>
    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Rank</th>
            <th>Primary Team</th>
            <th>Other Teams</th>
            <th>Action</th>
        </tr>
        <?php
        foreach (Admin::getAdmins() as $user) {
            if ($user->getID() != 0) {
                ?>
                <tr>
                    <td><?php echo $user->getName() ?></td>
                    <td><?php echo $user->getAdmin()->getAdminRank() ?></td>
                    <td><?php echo $user->getAdmin()->getPrimaryTeam()->getName() ?></td>
                    <td class="text-center"><?php echo count($user->getAdmin()->getOtherTeams()) ?></td>
                    <td>
                        <?php
                        if (($_SESSION['user']->getAdmin()->getAdminLevel() > $user->getAdmin()->getAdminLevel()) || $_SESSION['user']->getAdmin()->getAdminLevel() == 5) {
                            ?>
                            <a onclick="load('admin', 'edit', 'none', {id: '<?php echo $user->getID() ?>'})">Edit</a> || <a
                                onclick="load('admin', 'remove', 'none', {id: '<?php echo $user->getID() ?>'})">Remove</a>
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
    <center><a onclick="load('admin', 'add', 'none', {})">New Admin</a></center>
    <?php
} else if ($action == 'add') {
    if ($do == 'none') {
        ?>
        <form action="#" method="post" id="form">
            <table>
                <tr>
                    <th><label for="user">User:</label></th>
                    <td>
                        <select id="user" name="user">
                            <?php
                            foreach (User::getUsers($_SESSION['user'], true) as $user) {
                                if (!$user->getAdmin()) {
                                    ?>
                                    <option value=<?php echo $user->getID() ?>><?php echo $user->getName() ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="rank">Rank:</label></th>
                    <td>
                        <select id="rank" name="rank">
                            <?php
                            foreach (Admin::getAdminRanks() as $val => $rank) {
                                if ($val != 0) {
                                    ?>
                                    <option value=<?php echo $val ?>><?php echo $rank ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="primary">Primary Team:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="primary" name="primary" onchange="disableCheckBox()">
                            <option value="">-- Select a Team --</option>
                            <?php
                            $div = new Division(0);
                            foreach ($div->getSubDivisions() as $division) {
                                ?>
                                <option value=<?php echo $division->getDivision() ?>><?php echo $division->getName() ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                foreach ($div->getSubDivisions() as $division) {
                    ?>
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" class="others" name="others[]" id="<?php echo strtolower($division->getName()) ?>" value=<?php echo $division->getDivision() ?> /> <label for="<?php echo strtolower($division->getName()) ?>"><?php echo $division->getName() ?></label>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="2"><button id="create" name="create" class="btn btn-primary" type="button" onclick="createAdmin()">Create</button></td>
                </tr>
            </table>
        </form>
        <div id="error" class="alert alert-danger" role="alert" style="display: none">

        </div>
        <?php
    } else if($do == 'add') {
        extract($_POST);

        if (!empty($others))
            $teams = $others;

        if ($primary == '') {
            echo 'Primary Team Not Specified';
        } else {
            if (!isset($teams) || $teams == '') {
                $teams = array($primary);
            } else {
                array_unshift($teams, $primary);
            }
            Admin::create($user, $rank, $teams);
            echo 'true';
        }
    }
} else if ($action == 'edit') {
    $user = new User($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post" id="form">
            <table>
                <tr>
                    <th><label for="rank">Rank:</label></th>
                    <td>
                        <select id="rank" name="rank">
                            <?php
                            foreach (Admin::getAdminRanks() as $val => $rank) {
                                if ($val != 0) {
                                    if ($user->getAdmin()->getAdminLevel() == $val) {
                                        ?>
                                        <option value=<?php echo $val ?> selected><?php echo $rank ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value=<?php echo $val ?>><?php echo $rank ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="primary">Primary Team:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="primary" name="primary" onchange="disableCheckBox()">
                            <option value="">-- Select a Team --</option>
                            <?php
                            $div = new Division(0);
                            foreach ($div->getSubDivisions() as $division) {
                                if ($user->getAdmin()->getPrimaryTeam()->getDivision() == $division->getDivision()) {
                                    ?>
                                    <option value=<?php echo $division->getDivision() ?> selected><?php echo $division->getName() ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value=<?php echo $division->getDivision() ?>><?php echo $division->getName() ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                foreach ($div->getSubDivisions() as $division) {
                    if (in_array($division, $user->getAdmin()->getOtherTeams())) {
                        ?>
                        <tr>
                            <td colspan="2">
                                <input type="checkbox" class="others" name="others[]" id="<?php echo strtolower($division->getName()) ?>" value=<?php echo $division->getDivision() ?> checked /> <label for="<?php echo strtolower($division->getName()) ?>"><?php echo $division->getName() ?></label>
                            </td>
                        </tr>
                        <?php
                    } else {
                        if ($user->getAdmin()->getPrimaryTeam()->getDivision() == $division->getDivision()) {
                            ?>
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" class="others" name="others[]" id="<?php echo strtolower($division->getName()) ?>" value=<?php echo $division->getDivision() ?> disabled /> <label for="<?php echo strtolower($division->getName()) ?>"><?php echo $division->getName() ?></label>
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" class="others" name="others[]" id="<?php echo strtolower($division->getName()) ?>" value=<?php echo $division->getDivision() ?> /> <label for="<?php echo strtolower($division->getName()) ?>"><?php echo $division->getName() ?></label>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
                <tr>
                    <td colspan="2"><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editAdmin(<?php echo $user->getID() ?>)">Edit</button></td>
                </tr>
            </table>
        </form>
        <div id="error" class="alert alert-danger" role="alert" style="display: none">

        </div>
        <?php
    } else if($do == 'edit') {
        extract($_POST);

        if (!empty($others))
            $teams = $others;

        if ($primary == '') {
            echo 'Primary Team Not Specified';
        } else {
            if (!isset($teams) || $teams == '') {
                $teams = array($primary);
            } else {
                array_unshift($teams, $primary);
            }
            $user->getAdmin()->update($rank, $teams);
            echo 'true';
        }
    }
} else if ($action == 'remove') {
    if ($do == 'none') {
        ?>
        <a onclick="load('admin', 'remove', 'remove', {id: '<?php echo $_GET['id'] ?>'})">Continue?</a> (<b>NOTE:</b> This action cannot be reversed!)
        <?php
    } else if ($do == 'remove') {
        $user = new User($_GET['id']);
        $user->getAdmin()->remove();
        ?>
        <script>
            load('admin', 'none', 'none', {});
        </script>
        <?php
    }
}