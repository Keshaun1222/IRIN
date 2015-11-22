<?php
require_once('lib/path.php');
$users = User::getUsers($_SESSION['user']);
?>
<h1>Security Clearances</h1>
<table class="table table-hover">
    <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Email</th>
        <th>Clearance</th>
    </tr>
    <?php
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?php echo $user->getRank()->getName() ?></td>
            <td><?php echo $user->getName() ?></td>
            <td><a href="mailto:<?php echo $user->getEmail() ?>"><?php echo $user->getEmail() ?></a></td>
            <td><?php echo $user->getClearance()->getClearanceName() ?></td>
        </tr>
        <?php
    }
    ?>
</table>