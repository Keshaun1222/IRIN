<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Rank Information</h1>';

$divisions = Division::getAllDivisions();

if ($action == 'none') {
    foreach ($divisions as $division) {
        $ranks = Rank::getDivisionRanks($division);
        if (count($ranks) > 0) {
            ?>
            <h3><?php echo $division->getName() ?></h3>
            <table class="table table-hover">
                <tr>
                    <th>Rank Name</th>
                    <th>Rank Abbreviation</th>
                    <th>Rank Paygrade</th>
                    <th>Option(s)</th>
                </tr>
            <?php
            foreach ($ranks as $rank) {
                ?>
                <tr>
                    <td><?php echo $rank->getName() ?></td>
                    <td><?php echo $rank->getAbbrev() ?></td>
                    <td><?php echo $rank->getPaygrade() ?></td>
                    <td><a onclick="load('ranks', 'edit', 'none', {id:'<?php echo $rank->getRank() ?>'})">Edit</a> || <a onclick="load('ranks', 'delete', 'none', {id:'<?php echo $rank->getRank() ?>'})">Delete</a></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
    }
    ?>
    <center><a onclick="load('ranks', 'create', 'none', {})">Create New Rank</a></center>
    <?php
} else if ($action == 'edit') {
    $rank = new Rank($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $rank->getRank() ?>" />
            <table>
                <tr>
                    <th><label for="name">Rank Name:</label></th>
                    <td><input type="text" id="name" name="name" value="<?php echo $rank->getName() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="abbrev">Rank Abbreviation:</label>&nbsp;&nbsp;</th>
                    <td><input type="text" id="abbrev" name="abbrev" value="<?php echo $rank->getAbbrev() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="paygrade">Rank Paygrade:</label></th>
                    <td><input type="text" id="paygrade" name="paygrade" value="<?php echo $rank->getPaygrade() ?>"  required /></td>
                </tr>
                <tr>
                    <th><label for="division">Division:</label></th>
                    <td>
                        <select id="division" name="division">
                            <?php
                            foreach (Division::getAllDivisions() as $division) {
                                if ($rank->getDivision()->getDivision() == $division->getDivision())
                                    echo '<option value=' . $division->getDivision() . ' selected>' . $division->getName() . '</option>';
                                else
                                    echo '<option value=' . $division->getDivision() . '>' . $division->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editRank()">Edit</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'edit') {
        extract($_POST);
        $rank->update($name, $division, $abbrev, $paygrade);
        Event::addEvent('Rank <b>' . $ranks->getName() . '</b> has been modified.', $_SESSION['user'], 2);
    }
} else if ($action == 'create') {
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <th><label for="name">Rank Name:</label></th>
                    <td><input type="text" id="name" name="name" required/></td>
                </tr>
                <tr>
                    <th><label for="abbrev">Rank Abbreviation:</label>&nbsp;&nbsp;</th>
                    <td><input type="text" id="abbrev" name="abbrev" required/></td>
                </tr>
                <tr>
                    <th><label for="paygrade">Rank Paygrade:</label></th>
                    <td><input type="text" id="paygrade" name="paygrade" required/></td>
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
                    <td colspan="2">
                        <button id="create" name="create" class="btn btn-primary" type="button" onclick="createRank()">Create</button>
                    </td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'create') {
        extract($_POST);
        Rank::create($name, $division, $abbrev, $paygrade);
        Event::addEvent('Rank <b>' . $name . '</b> has been created.', $_SESSION['user'], 1);
    }
} else if ($action == 'delete') {
    if ($do == 'none') {
        ?>
        <a onclick="load('ranks', 'delete', 'delete', {id: '<?php echo $_GET['id'] ?>'})">Continue?</a> (<b>NOTE:</b> This action cannot be reversed!)
        <?php
    } else if ($do == 'delete') {
        $ranks = new Rank($_GET['id']);
        $ranks->delete();
        Event::addEvent('Rank <b>' . $ranks->getName() . '</b> has been deleted.', $_SESSION['user'], 3);
        ?>
        <script>
            load('ranks', 'none', 'none', {});
        </script>
        <?php
    }
}