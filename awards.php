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
    $awards = Award::getAllAwards();
    $count = count($awards) + 30;
    $current = 0;
    $line = 0;

    if ($do == 'none' || $do == 'ribbon') {
        ?>
        <center>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Ribbons</button>
                <button type="button" class="btn btn-default" onclick="load('awards', 'list', 'medal', {})">Medals</button>
            </div>
        </center>
        <br />
        <?php
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
        ?>
        <center>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" onclick="load('awards', 'list', 'ribbon', {})">Ribbons</button>
                <button type="button" class="btn btn-default">Medals</button>
            </div>
        </center>
        <br />
        <?php
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
        ?>
        <h3><?php echo $user->getName() ?></h3>
        <?php
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
} else if ($action == 'edit') {
    $user = new User($_GET['id']);
    if ($do == 'none') {
        ?>
        <form action="#" method="post" id="form">
            <table>
                <?php
                foreach (Award::getAll() as $award) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (Award::hasAward($user, $award)) {
                                ?>
                                <input type="checkbox" class="awards" name="awards[]" id="<?php echo strtolower($award->getAbbrev()) ?>" value=<?php echo $award->getAward() ?> checked />
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" class="awards" name="awards[]" id="<?php echo strtolower($award->getAbbrev()) ?>" value=<?php echo $award->getAward() ?> />
                                <?php
                            }
                            ?>
                            &nbsp;
                        </td>
                        <td>
                            <label for="<?php echo strtolower($award->getAbbrev()) ?>"><?php echo $award->getName() ?></label>
                        </td>
                        <td>
                            <?php
                            if (Award::isMulti($award->getAward())) {
                                ?>
                                <select name="<?php echo strtolower($award->getAbbrev()) ?>Multi">
                                    <?php
                                    if ($award->getAward() == 40 || $award->getAward() == 41) {
                                        $new = new Award($award->getAward(), 'Half');
                                        if (Award::hasAward($user, $new, true)) {
                                            ?>
                                            <option value="Half" selected>Half</option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="Half">Half</option>
                                            <?php
                                        }
                                        for ($i = 1; $i <= 8; $i++) {
                                            $new = new Award($award->getAward(), $i);
                                            if (Award::hasAward($user, $new, true)) {
                                                ?>
                                                <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                            }
                                        }
                                    } else if ($award->getAward() == 42 || $award->getAward() == 43) {
                                        for ($i = 3; $i <= 24; $i *= 2) {
                                            $new = new Award($award->getAward(), $i);
                                            if (Award::hasAward($user, $new, true)) {
                                                ?>
                                                <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                            }
                                        }
                                    } else if ($award->getAward() == 36 || $award->getAward() == 39) {
                                        for ($i = 1; $i <= 5; $i++) {
                                            $new = new Award($award->getAward(), $i);
                                            if (Award::hasAward($user, $new, true)) {
                                                ?>
                                                <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td><button id="edit" name="edit" class="btn btn-primary" type="button" onclick="editAwards(<?php echo $user->getID() ?>)">Edit</button></td>
                    <td></td>
                </tr>
            </table>
        </form>
        <div id="test"></div>
        <?php
    } else if ($do == 'edit') {
        //var_dump($_POST);
        extract($_POST);

        $awardlist = '';
        $multi = '';

        for($i = 0; $i < count($awards); $i++) {
            $awardlist .= $awards[$i];
            if ($i < count($awards) - 1) {
                $awardlist .= ',';
            }

            if (Award::isMulti($awards[$i])) {
                $award = new Award($awards[$i], NULL, false);
                $multiName = strtolower($award->getAbbrev()) . 'Multi';
                $multi .= $$multiName . ',';
            }
        }

        $multi = rtrim($multi, ',');

        Award::updateUserAwards($user, $awardlist, $multi);
    }
}