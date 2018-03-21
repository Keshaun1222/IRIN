<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none')
    echo '<h1>IRIN System Version Update</h1>';

if ($action == 'none') {
    ?>
    <table class="table table-hover">
        <tr>
            <th>Version</th>
            <th>Updated</th>
            <th></th>
        </tr>
        <?php
        foreach (Version::getVersions() as $version) {
            ?>
            <tr>
                <td>
                    <?php echo $version->getVersion() ?>
                    <?php if ($version->isCurrent()) echo '(Current)'; ?>
                </td>
                <td><?php echo $version->getDate() ?></td>
                <td>
                    <?php
                    if (!$version->isCurrent()) {
                        ?>
                        <a onclick="load('version', 'current', 'none', {id: '<?php echo $version->getID() ?>'})">Make Current</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <center><a onclick="load('version', 'add', 'none', {})">Add New Version</a></center>
    <?php
} else if ($action == 'add') {
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <th><label for="vers">Version:</label></th>
                    <td><input type="text" id="vers" name="vers" required /></td>
                </tr>
                <tr>
                    <th><label for="ver">Version Type:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="ver" name="ver">
                            <option value="none">Normal</option>
                            <option value="alpha">Alpha</option>
                            <option value="beta">Beta</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="new" name="new" class="btn btn-primary" type="button" onclick="createVersion()">Create</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'add') {
        $version = $_POST['version'];
        ?>
        <?php
        switch ($_POST['ver']) {
            case "alpha":
                $version .= '&alpha;';
                break;
            case "beta":
                $version .= '&beta;';
                break;
        }
        Version::create($version);
        Event::addEvent('Version <b>' . $version . '</b> has been added.', $_SESSION['user'], 1);
    }
} else if ($action == 'current') {
    $version = new Version($_GET['id']);
    $version->makeCurrent();

    Event::addEvent('Version <b>' . $version->getVersion() . '</b> is now the current version.', $_SESSION['user'], 2);
    ?>
    <script>
        load('version', 'none', 'none');
    </script>
    <?php
}