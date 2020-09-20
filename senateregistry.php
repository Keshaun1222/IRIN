<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Senate Registry</h1>';

if ($action == 'none') {
    if (count(Senator::getPendingSenators()) > 0) {
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
                <td></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}