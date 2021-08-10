<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Senate Registry</h1>';

if ($action == 'none') {
    if (count(Senator::getPendingSenators()) > 0 && $_SESSION['user']->getAdmin()) {
        ?>
        <a onclick="load('senateregistry', 'pending', 'none', {})">View Pending Senators</a>
        <?php
    }
    $senators = Senator::getSenators();
    ?>
    <table class="table table-hover">
        <tr>
            <th>System/Planet</th>
            <th>Member Name</th>
            <th>Senator Name</th>
            <th>Senator Type</th>
            <th>Committee</th>
            <th>Status</th>
            <th>Option(s)</th>
        </tr>
        <?php
        foreach ($senators as $senator) {
            ?>
            <tr>
                <td><?php echo $senator->getLocation(); ?></td>
                <td><?php echo $senator->getMember()->getName(); ?></td>
                <td><?php echo $senator->getName(); ?></td>
                <td><?php echo $senator->getType(); ?></td>
                <td><?php echo $senator->getCommittee(); ?></td>
                <td>
                    <?php
                    if ($senator->isChair()) {
                        echo 'Chair';
                    } else {
                        echo 'Active';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($_SESSION['user']->getAdmin()) {
                    ?>
                        <a onclick="load('senateregistry', 'edit', 'none', {id: '<?php echo $senator->getID() ?>'})">Edit</a> ||
                        <a onclick="load('senateregistry', 'inactive', 'none', {id: '<?php echo $senator->getID() ?>'})">Make Inactive</a> ||
                        <a onclick="load('senateregistry', 'chair', 'none', {id: '<?php echo $senator->getID() ?>'})">
                            <?php
                            if ($senator->isChair()) {
                                echo 'Remove From Chair';
                            } else {
                                echo 'Make Chair';
                            }
                            ?>
                        </a>
                        <?php
                    } else if ($_SESSION['user']->getID() == $senator->getMember()->getID()) {
                        ?>
                        <a onclick="load('senateregistry', 'edit', 'none', {id: '<?php echo $senator->getID() ?>'})">Edit</a>
                        <?php
                    }
                        ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} elseif ($action == 'edit') {
    $senator = new Senator($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $senator->getID() ?>" />
            <table>
                <tr>
                    <th><label for="name">Name:</label></th>
                    <td><input type="text" id="name" name="name" value="<?php echo $senator->getName() ?>" required /></td>
                </tr>
                <tr>
                    <th>Member:</th>
                    <td><?php echo $senator->getMember()->getName() ?></td>
                </tr>
                <tr>
                    <th><label for="location">System/Planet:</label></th>
                    <td><input type="text" id="location" name="location" value="<?php echo $senator->getLocation() ?>" required /></td>
                </tr>
                <!--<tr>
                    <th><label for="committee">Committee:</label></th>
                    <td>
                        <select id="committee" name="committee">
                            <?php
                            foreach (Senator::getCommittees() as $index => $committee) {
                                ?>
                                <option value=<?php echo $index ?> <?php if ($senator->getCommittee() == $committee) echo 'selected' ?>><?php echo $committee ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>-->
                <tr>
                    <th><label for="type">Senator Type:</label></th>
                    <td>
                        <select id="type" name="type">
                            <?php
                            $types = array("Elected", "Appointed");
                            foreach ($types as $val => $type) {
                                ?>
                                <option value=<?php echo $val ?> <?php if ($senator->getType() == $type) echo 'selected' ?>><?php echo $type ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editSenator()">Edit</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } elseif ($do == 'edit') {
        extract($_POST);
        Event::addEvent('Senator ' . $name . ' has been modified.', $_SESSION['user'], 2);
        $senator->update($name, $location, $type);
    }
} elseif ($action == 'pending') {
    if ($do == 'none') {
        $senators = Senator::getPendingSenators();
        ?>
        <table class="table table-hover">
            <tr>
                <th>System/Planet</th>
                <th>Member Name</th>
                <th>Senator Name</th>
                <th>Senator Type</th>
                <th>Option(s)</th>
            </tr>
        <?php
        foreach ($senators as $senator) {
            ?>
            <tr>
                <td><?php echo $senator->getLocation(); ?></td>
                <td><?php echo $senator->getMember()->getName(); ?></td>
                <td><?php echo $senator->getName(); ?></td>
                <td><?php echo $senator->getType(); ?></td>
                <td>
                    <a onclick="load('senateregistry', 'pending', 'approve', {id: '<?php echo $senator->getID() ?>'})">Approve</a> ||
                    <a onclick="load('senateregistry', 'pending', 'deny', {id: '<?php echo $senator->getID() ?>'})">Remove</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    } elseif ($do == 'approve') {
        $senator = new Senator($_GET['id']);
        ?>
        <form action="#" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $senator->getID() ?>" />
            <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $senator->getName() ?></td>
                </tr>
                <tr>
                    <th>Member:</th>
                    <td><?php echo $senator->getMember()->getName() ?></td>
                </tr>
                <tr>
                    <th><label for="committee">Committee:</label></th>
                    <td>
                        <select id="committee" name="committee">
                            <?php
                            foreach (Senator::getCommittees() as $index => $committee) {
                                ?>
                                <option value=<?php echo $index ?> <?php if ($senator->getCommittee() == $committee) echo 'selected' ?>><?php echo $committee ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="approveSenator()">Edit</button></td>
                </tr>
            </table>
        </form>
        <?php
    }
}