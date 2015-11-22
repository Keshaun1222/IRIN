<?php
require_once('lib/path.php');
if ($down || !isset($_SESSION['user'])) {
    header('Location: index.php');
}
$pages = Page::getPages($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Imperial Republic Information Network</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <h1>Imperial Republic Information Network</h1>
        <div class="row">
            <div id="sidebar" class="col-md-3">
                <div id="top"></div>
                <div id="pages">
                    <div class="panel-group" id="menu" role="tablist" aria-multiselectable="true">
                        <?php
                        foreach ($pages as $page) {
                            //echo '<a href="#" alt="' . $page->getDesc() . '" onclick="">' . $page->getName() . '</a><br />';
                            if ($page->getPage() == 'home') {
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="<?php echo $page->getPage() ?>">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-parent="#menu" aria-expanded="false" aria-controls="<?php echo $page->getPage() ?>Collapse" onclick="load('<?php echo $page->getPage() ?>', 'none', 'none', {})">
                                                <?php echo $page->getName() ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $page->getPage() ?>Collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $page->getPage() ?>">
                                        <div class="panel-body">
                                            Action: none
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="<?php echo $page->getPage() ?>">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-parent="#menu" aria-expanded="false" aria-controls="<?php echo $page->getPage() ?>Collapse" onclick="load('<?php echo $page->getPage() ?>', 'none', 'none', {})">
                                                <?php echo $page->getName() ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $page->getPage() ?>Collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $page->getPage() ?>">
                                        <div class="panel-body">

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="logout">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-parent="#menu" aria-expanded="false" aria-controls=logoutCollapse" onclick="load('logout', 'none', 'none', {})">
                                        Logout
                                    </a>
                                </h4>
                            </div>
                            <div id="logoutCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="logout">
                                <div class="panel-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<a href="logout.php" alt="Logout">Logout</a>-->
                </div>
                <div id="blank"></div>
                <div id="session">
                    <b>Username: </b><?php echo $_SESSION['user']->getName() ?><br />
                    <b>Rank: </b><?php echo $_SESSION['user']->getRank()->getName() ?><br />
                    <b>Clearance: </b><?php echo $_SESSION['user']->getClearance()->getClearanceName() ?><br />
                </div>
                <!--<div id="bottom"></div>-->
            </div>
            <div id="main" class="col-md-9">

            </div>
        </div>
        <div id="footer" class="row">
            <span>Year of the IR&nbsp;&nbsp;<?php echo Year::getCurrentYear()->getFullYear() ?></span>
            <span class="pull-right">IRIN Version&nbsp;&nbsp;<?php echo Version::getLatestVersion()->getVersion() ?></span>
        </div>
    </div>
</body>
</html>
