<?php
require_once('lib/path.php');
$action = param('action', 'none');

if ($action == 'none') {
    ?>
    <button id="generate" name="submit" class="btn btn-lg btn-primary" onclick="generateCode()">Generate Code</button>
    <h4 id="code"></h4>
    <?php
} else if ($action == 'generate') {
    $rand = rand(100, 999);
    $date = date('mdy');
    $name = strtoupper($_SESSION['user']->getName()[0] . $_SESSION['user']->getName()[1]);

    $abbrev = '';

    foreach (explode(' ', $_SESSION['user']->getAdmin()->getAdminRank()) as $word) {
        $abbrev .= strtoupper($word[0]);
    }

    echo $date . $name . $abbrev . $rand;
}