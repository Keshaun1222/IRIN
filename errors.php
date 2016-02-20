<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Error Logger</h1>';

if ($action == 'none') {
    $types = array('Database Exception', 'IRIN Exception', 'Fatal Error');

    for ($i = 0; $i < count($types); $i++) {
        ?>
        <h3><?php echo $types[$i] ?></h3>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Time</th>
            </tr>
        <?php
        $errors = Error::getErrors($i + 1);
        foreach ($errors as $error) {
            ?>
            <tr>
                <td><a onclick="load('errors', 'view', 'none', {id:'<?php echo $error->getID() ?>'})"><?php echo $error->getID() ?></a></td>
                <td><?php echo $error->getMessage() ?></td>
                <td><?php echo $error->getDate() ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
} else if ($action == 'view') {
    $error = new Error(param('id'));
    ?>
    <h3>Error #<?php echo $error->getID() ?></h3>
    <table>
        <tr>
            <th>Message:&nbsp;&nbsp;</th>
            <td><?php echo $error->getMessage() ?></td>
        </tr>
        <tr>
            <th>Time:</th>
            <td><?php echo $error->getDate() ?></td>
        </tr>
    </table><br />
    <?php
    echo $error->printStackTrace();
}