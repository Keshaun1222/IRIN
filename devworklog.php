<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Developer\'s Work Log</h1>';

if ($action == 'none') {
    $worklog = DevWorklog::getAllWorklog();
    foreach ($worklog as $log) {
        echo $log;
        $todos = array();
        if (($_SESSION['user']->getAdmin()->getAdminLevel() == 3 && $_SESSION['user']->getAdmin()->getPrimaryTeam()->getDivision() == 31) || $_SESSION['user']->getAdmin()->getAdminLevel() > 3) {
            if ($log->isInProgress()) {
                $todos[] = 'edit';
                if (!$log->getAssigned()) {
                    $todos[] = 'assign';
                }
                $todos[] = 'cancel';
            }
        }

        if ($log->isInProgress() && $log->getAssigned() && $log->getAssigned()->getID() == $_SESSION['user']->getID()) {
            $todos[] = 'completed';
        }

        foreach ($todos as $todo) {
            ?>
            &nbsp;&nbsp;<a onclick="load('devworklog', '<?php echo $todo ?>', 'none', {id:'<?php echo $log->getID() ?>'})"><?php echo ucfirst($todo) ?></a>
            <?php
        }

        echo '<br /><br />';
    }
    ?>
    <center><a onclick="load('devworklog', 'new', 'none', {})">Create New PCR</a></center>
    <?php
} else if ($action == 'new') {
    if ($do == 'none') {
        $worklog = DevWorklog::getLatestWorklog();
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <td><label for="pcrNum">PCR Number:</label></td>
                    <td>
                        <input type="number" id="pcrNum" name="pcrNum" max="999" style="width: 50px;" required />
                        <label for="minorPCR">.</label>
                        <input type="number" id="minorPCR" name="minorPCR" max="99" style="width: 44px;" />
                    </td>
                </tr>
                <tr>
                    <td><label for="text">PCR Description:</label>&nbsp;&nbsp;</td>
                    <td><textarea id="text" name="text" rows="4" cols="40" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="submit" name="submit" class="btn btn-lg btn-primary" type="button" onclick="createPCR();">Create</button></td>
                </tr>
            </table><br />
            <i>Latest PCR</i><br />
            <?php echo $worklog; ?>
        </form>
        <div id="loading" class="alert alert-primary" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'add') {
        if (isset($_POST['minorPCR']) && $_POST['minorPCR'] != '') {
            DevWorklog::create($_POST['text'], $_POST['pcrNum'], $_POST['minorPCR']);
        } else {
            DevWorklog::create($_POST['text'], $_POST['pcrNum']);
        }
    }
} else if ($action == 'edit') {
    $worklog = new DevWorklog(param('id'));
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <td><label for="pcrNum">PCR Number:</label></td>
                    <td>
                        <input type="number" id="pcrNum" name="pcrNum" max="999" value="<?php echo $worklog->getPCRNum() ?>" style="width: 50px;" required />
                        <label for="minorPCR">.</label>
                        <input type="number" id="minorPCR" name="minorPCR" max="99" value="<?php echo $worklog->getMinorPCR() ?>" style="width: 44px;" />
                    </td>
                </tr>
                <tr>
                    <td><label for="text">PCR Description:</label>&nbsp;&nbsp;</td>
                    <td><textarea id="text" name="text" rows="4" cols="40" required><?php echo $worklog->getText() ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" id="id" name="id" value="<?php echo $worklog->getID() ?>" />
                        <button id="submit" name="submit" class="btn btn-primary" type="button" onclick="editPCR();">Edit</button>
                    </td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'edit') {
        if (isset($_POST['minorPCR']) && $_POST['minorPCR'] != '') {
            $worklog->update($_POST['text'], $_POST['pcrNum'], $_POST['minorPCR']);
        } else {
            $worklog->update($_POST['text'], $_POST['pcrNum']);
        }
    }
} else if ($action == 'assign') {
    $worklog = new DevWorklog($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $worklog->getID() ?>" />
            <label for="assigned">Assign To:</label>&nbsp;&nbsp;
            <select id="assigned" name="assigned">
                <?php
                foreach (User::getTeamUsers(new Division(31), $_SESSION['user']) as $user) {
                    ?>
                    <option value="<?php echo $user->getID() ?>"><?php echo $user->getName() ?></option>
                    <?php
                }
                ?>
            </select><br />
            <button id="assign" name="assign" class="btn btn-primary" type="button" onclick="assignPCR()">Assign</button>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'assign') {
        $worklog->assign(new User($_POST['assigned']));
    }
} else if ($action == 'completed') {
    $worklog = new DevWorklog($_GET['id']);
    $worklog->complete();
    ?>
    <script>
        load('devworklog', 'none', 'none', {});
    </script>
    <?php
} else if ($action == 'cancel') {
    $worklog = new DevWorklog($_GET['id']);
    if ($do == 'none') {
        ?>
        <center>
            Are you sure you want to cancel this PCR?<br />
            <a onclick="load('devworklog', 'cancel', 'cancel', {id: '<?php echo $worklog->getID() ?>'})">Yes</a> || <a onclick="load('devworklog', 'none', 'none', {})">No</a>
        </center>
        <?php
    } else if ($do == 'cancel') {
        $worklog->cancel();
        ?>
        <script>
            load('devworklog', 'none', 'none', {});
        </script>
        <?php
    }
}