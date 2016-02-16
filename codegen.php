<?php
require_once('lib/path.php');
$action = param('action', 'none');

if ($action == 'none') {
    ?>
    <h1>Code Generator</h1>
    <form action="#" method="post">
        <table>
            <tr>
                <td><label for="purpose">Purpose: </label></td>
                <td><textarea id="purpose" name="purpose" rows="4" cols="40" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><button id="generate" name="submit" class="btn btn-lg btn-primary" type="button" onclick="generateCode()">Generate Code</button></td>
            </tr>
        </table>
    </form>
    <!--<h4 id="code"></h4>-->
    <table class="table table-hover">
        <tr>
            <th>Code</th>
            <th>User</th>
            <th>Purpose</th>
            <th>Date</th>
        </tr>
    <?php
    foreach (CodeGen::getAll() as $code) {
        ?>
        <tr>
            <th style="vertical-align: middle"><?php echo $code->getCode() ?></th>
            <td style="vertical-align: middle"><?php echo $code->getUser()->getName() ?></td>
            <td style="vertical-align: middle"><?php echo $code->getPurpose() ?></td>
            <td style="vertical-align: middle"><?php echo $code->getDate() ?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
} else if ($action == 'generate') {
    /*$rand = rand(100, 999);
    $date = date('mdy');
    $name = strtoupper($_SESSION['user']->getName()[0] . $_SESSION['user']->getName()[1]);

    $abbrev = '';

    foreach (explode(' ', $_SESSION['user']->getAdmin()->getAdminRank()) as $word) {
        $abbrev .= strtoupper($word[0]);
    }*/

    $code = CodeGen::generateCode($_SESSION['user']);

    CodeGen::add($code, $_SESSION['user'], $_POST['purpose']);

    echo $code;
}