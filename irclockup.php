<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none')
    echo '<h1>Imperial Republic Year Update</h1>';

if ($action == 'none') {
    $page = intparam('page', 1);
    $prev = $page - 1;
    $next = $page + 1;
    $count = Year::getTotalYears();
    ?>
    <table class="table table-hover">
        <tr>
            <th>Year</th>
            <th>Updated</th>
            <th></th>
        </tr>
        <?php
        foreach (Year::getYears($page) as $year) {
            ?>
            <tr>
                <td>
                    <?php echo $year->getFullYear() ?>
                    <?php if ($year->isCurrent()) echo '(Current)'; ?>
                </td>
                <td><?php echo $year->getDate() ?></td>
                <td>
                    <?php
                    if (!$year->isCurrent()) {
                        ?>
                        <a onclick="load('irclockup', 'current', 'none', {id: '<?php echo $year->getID() ?>'})">Make Current</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td>
                <button id="prev" name="prev" class="btn btn-sm btn-default" type="button" <?php if ($prev > 0): ?>onclick="load('irclockup', 'none', 'none', {page: '<?php echo $prev ?>'})"<?php else: ?>disabled<?php endif; ?>>&laquo;Previous</button>
            </td>
            <td></td>
            <td class="text-right">
                <button id="next" name="next" class="btn btn-sm btn-default" type="button" <?php if ($count > ($page * 10)): ?>onclick="load('irclockup', 'none', 'none', {page: '<?php echo $next ?>'})"<?php else: ?>disabled<?php endif; ?>>Next&raquo;</button>
            </td>
        </tr>
    </table>
    <center><a onclick="load('irclockup', 'add', 'none', {})">Add New Year</a></center>
    <?php
} else if ($action == 'add') {
    if ($do == 'none') {
        ?>
        <form action="#" method="post">
            <table>
                <tr>
                    <th><label for="year">Year:</label>&nbsp;&nbsp;</th>
                    <td><input type="number" id="year" name="year" required /></td>
                </tr>
                <tr>
                    <th><label for="era">Era:</label></th>
                    <td>
                        <select id="era" name="era">
                            <option value=1>UFY</option>
                            <option value=2>IRY</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button id="new" name="new" class="btn btn-primary" type="button" onclick="createYear()">Create</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-info" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'add') {
        extract($_POST);
        Year::create($year, $era);
    }
} else if ($action == 'current') {
    $year = new Year($_GET['id']);
    $year->makeCurrent();
    ?>
    <script>
        load('irclockup', 'none', 'none');
    </script>
    <?php
}