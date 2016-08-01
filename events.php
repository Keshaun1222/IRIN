<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

echo '<h1>Event Logger</h1>';
if ($action == 'none') {
    $types = array('Addition Event', 'Change Event', 'Deletion Event', 'Other Events');

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
            $events = Event::getEvents($i + 1);
            foreach ($events as $event) {
                ?>
                <tr>
                    <td><a onclick="load('events', 'view', 'none', {id:'<?php echo $event->getID() ?>'})"><?php echo $event->getID() ?></a></td>
                    <td><?php echo $event->getMessage() ?></td>
                    <td><?php echo $event->getDate() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
} else if ($action == 'view') {
    $event = new Event(param('id'));
    ?>
    <h3>Error #<?php echo $event->getID() ?></h3>
    <table>
        <tr>
            <th>Message:&nbsp;&nbsp;</th>
            <td><?php echo $event->getMessage() ?></td>
        </tr>
        <tr>
            <th>User:</th>
            <td><?php echo $event->getUser()->getName() ?></td>
        </tr>
        <tr>
            <th>Time:</th>
            <td><?php echo $event->getDate() ?></td>
        </tr>
    </table>
    <?php
}