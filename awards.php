<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

// LOC and OSA are max 5, starting at 1
// ISM and CSA are max 8, starting at half
// IISM and CSM are max 24, starting at 3, doubling each time

if ($do == 'none' || $do == 'ribbon' || $do == 'medal' || $do == 'view')
    echo '<h1>Awards Tracker</h1>';

if ($action == 'none') {
    ?>
    <a onclick="load('awards', 'view', 'none', {})">View User Awards</a><br />
    <a onclick="load('awards', 'list', 'none', {})">View List of Awards</a><br />
    <?php
} else if ($action == 'list') {
    if ($do == 'none' || $do == 'ribbon') {
        $awards = Award::getAllAwards();
        $count = count($awards) + 30;
        $current = 0;
        $line = 0;

        foreach ($awards as $award) {
            if (Award::isMulti($award->getAward())) {
                if ($award->getAward() == 40 || $award->getAward() == 41) {
                    if ($current == 0) {
                        ?>
                        <div class="row">
                        <?php
                    }
                    $true = new Award($award->getAward(), "Half");
                    ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo $true->getRibbon() ?>"/>

                            <div class="caption">
                                <h3><?php echo $true->getAbbrev() ?></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    $current++;
                    if ($current == 4 || ($line * 4) + $current == $count) {
                        $current = 0;
                        $line++;
                        ?>
                        </div>
                        <?php
                    }
                    for ($i = 1; $i <= 8; $i++) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getRibbon() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                } else if ($award->getAward() == 42 || $award->getAward() == 43) {
                    for ($i = 3; $i <= 24; $i *= 2) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getRibbon() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                } else if ($award->getAward() == 36 || $award->getAward() == 39) {
                    for ($i = 1; $i <= 5; $i++) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getRibbon() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                if ($current == 0) {
                    ?>
                    <div class="row" style="border: none;">
                    <?php
                }
                ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo $award->getRibbon() ?>"/>

                        <div class="caption">
                            <h3><?php echo $award->getAbbrev() ?></h3>
                        </div>
                    </div>
                </div>
                <?php
                $current++;
                if ($current == 4 || ($line * 4) + $current == $count) {
                    $current = 0;
                    $line++;
                    ?>
                    </div>
                    <?php
                }
            }
        }
    } else if ($do == 'medal') {
        foreach ($awards as $award) {
            if (Award::isMulti($award->getAward())) {
                if ($award->getAward() == 40 || $award->getAward() == 41) {
                    if ($current == 0) {
                        ?>
                        <div class="row">
                        <?php
                    }
                    $true = new Award($award->getAward(), "Half");
                    ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo $true->getMedal() ?>"/>

                            <div class="caption">
                                <h3><?php echo $true->getAbbrev() ?></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    $current++;
                    if ($current == 4 || ($line * 4) + $current == $count) {
                        $current = 0;
                        $line++;
                        ?>
                        </div>
                        <?php
                    }
                    for ($i = 1; $i <= 8; $i++) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getMedal() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                } else if ($award->getAward() == 42 || $award->getAward() == 43) {
                    for ($i = 3; $i <= 24; $i *= 2) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getMedal() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                } else if ($award->getAward() == 36 || $award->getAward() == 39) {
                    for ($i = 1; $i <= 5; $i++) {
                        if ($current == 0) {
                            ?>
                            <div class="row">
                            <?php
                        }
                        $true = new Award($award->getAward(), $i);
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo $true->getMedal() ?>"/>

                                <div class="caption">
                                    <h3><?php echo $true->getAbbrev() ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $current++;
                        if ($current == 4 || ($line * 4) + $current == $count) {
                            $current = 0;
                            $line++;
                            ?>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                if ($current == 0) {
                    ?>
                    <div class="row" style="border: none;">
                    <?php
                }
                ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo $award->getMedal() ?>"/>

                        <div class="caption">
                            <h3><?php echo $award->getAbbrev() ?></h3>
                        </div>
                    </div>
                </div>
                <?php
                $current++;
                if ($current == 4 || ($line * 4) + $current == $count) {
                    $current = 0;
                    $line++;
                    ?>
                    </div>
                    <?php
                }
            }
        }
    }
} else if ($action == 'view') {
    if ($do == 'none') {
        ?>
        <table class="table table-hover">
            <tr>
                <th>User</th>
                <th>Rank</th>
                <th>Number of Awards</th>
                <th>Actions</th>
            </tr>
            <?php
            $users = User::getUsers($_SESSION['user'], true);
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?php echo $user->getName() ?></td>
                    <td><?php echo $user->getRank()->getName() ?></td>
                    <td><?php echo count($user->getAwards()) ?></td>
                    <td>
                        <a onclick="load('awards', 'view', 'view', {id:'<?php echo $user->getID() ?>'})">View</a>
                        <?php
                        if ($_SESSION['user']->getApprover() || $_SESSION['user']->getNominator() || $_SESSION['user']->getAdmin()) {
                            ?>
                             || <a onclick="load('awards', 'edit', 'none', {id:'<?php echo $user->getID() ?>'})">Edit</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else if ($do == 'view') {
        $id = param('id');
        $user = new User($id);
        $awards = Award::getUserAwards($user);

        $count = count($awards);
        $current = 0;
        $line = 0;

        foreach($awards as $award) {
            if ($current == 0) {
                ?>
                <div class="row">
                <?php
            }
            ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?php echo $award->getRibbon() ?>"/>

                    <div class="caption">
                        <h3><?php echo $award->getAbbrev() ?></h3>
                    </div>
                </div>
            </div>
            <?php
            $current++;
            if ($current == 4 || ($line * 4) + $current == $count) {
                $current = 0;
                $line++;
                ?>
                </div>
                <?php
            }
        }
    }
}