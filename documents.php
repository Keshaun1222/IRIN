<?php
require_once('lib/path.php');
$action = param('action', 'none');
$do = param('do', 'none');

if ($do == 'none') {
    echo '<h1>IRIN Documents</h1>';
}

if ($action == 'none') {
    ?>
    <a onclick="load('documents', 'view', 'none', {})">View Documents/Orders</a><br />
    <a onclick="load('documents', 'search', 'none', {})">Search Documents/Orders</a><br />
    <a onclick="load('documents', 'new', 'none', {})">New Documents/Orders</a>
    <?php
} else if ($action == 'view') {
    $documents = Document::getDocuments($_SESSION['user']);
    ?>
    <table class="table table-hover">
        <?php
        if (!isset($_GET['id'])) {
            ?>
            <tr>
                <th>Message ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Clearance</th>
                <th>Status</th>
            </tr>
            <?php
            foreach ($documents as $document) {
                ?>
                <tr>
                    <th><a onclick="load('documents', 'view', 'none', {id:'<?php echo $document->getID() ?>'})"><?php echo $document->getPrefix()->getPrefixAbbrev() . $document->getID() ?></a></th>
                    <td><?php echo $document->getTitle() ?></td>
                    <td><?php echo $document->getCreator()->getName() ?></td>
                    <td><?php echo $document->getDate() ?></td>
                    <td><?php echo $document->getClearance()->getClearanceName() ?></td>
                    <td><?php echo $document->getStatus()->getType() ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="6" style="text-align: center"><a onclick="load('documents', 'new', 'none', {})">New Document/Order</a> </td>
            </tr>
            <?php
        } else if (isset($_GET['id'])) {
            /*if (isset($_GET['search'])) {
                $_GET['id'] = substr_replace($_POST['searchid'], '', 0, 1);
            }*/
            $document = new Document($_GET['id']);
            ?>
            <tr>
                <td><span><a onclick="load('documents', 'view', 'none', {})">View Documents/Orders</a></span><span class="pull-right"><a onclick="load('documents', 'search', 'none', {})">Search Documents/Orders</a></span></td>
            </tr>
            <tr>
                <td>
                    <b>Message ID:</b> <?php echo $document->getPrefix()->getPrefixAbbrev() . $document->getID() ?> |
                    <b>Title:</b> <?php echo $document->getTitle() ?><br />
                    <b>By:</b> <?php echo $document->getCreator()->getRank()->getName() . ' ' . $document->getCreator()->getName() ?> |
                    <b>On:</b> <?php echo $document->getDate() ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Status:</b> <?php echo $document->getStatus()->getType() ?> ||
                    <b>Minimum Security Clearance:</b> <?php echo $document->getClearance()->getClearanceName() ?><br />
                    <b>Signed By:</b>
                    <?php
                    $signers = array();
                    foreach ($document->getSigners() as $signer) {
                        $signers[] = $signer->getRank()->getName() . ' ' . $signer->getName();
                    }
                    echo implode(', ', $signers);
                    ?> ||
                    <b>Assigned To:</b>
                    <?php
                    $assigned = array();
                    foreach ($document->getAssignees() as $assignee) {
                        $assigned[] = $assignee->getRank()->getName() . ' ' . $assignee->getName();
                    }
                    echo implode(', ', $assigned);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <i><?php echo stripslashes(nl2br($document->getContent())) ?></i>
                </td>
            </tr>
            <?php
            if ($_SESSION['user']->getAdmin() || $_SESSION['user']->isThrone() || $document->isCreator($_SESSION['user'])) {
                ?>
                <tr>
                    <td>
                        <b><a onclick="load('documents', 'edit', 'none', {id:'<?php echo $document->getID() ?>'})">Edit</a></b>
                        <?php
                        if ($_SESSION['user']->getAdmin()) {
                            ?>
                             || <b><a onclick="load('documents', 'delete', 'none', {id:'<?php echo $document->getID() ?>'})">Delete</a></b>
                            <?php
                        }
                        if (!in_array($_SESSION['user'], $document->getSigners())) {
                            ?>
                             || <b><a onclick="load('documents', 'sign', 'none', {id:'<?php echo $document->getID() ?>'})">Sign</a></b>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <?php
} else if ($action == 'edit') {
    $document = new Document($_GET['id']);
    if ($do == 'none') {
        $assignees = '';
        $assigneen = '';
        $signed = '';

        for ($i = 0; $i < count($document->getAssignees()); $i++) {
            $assignees .= $document->getAssignees()[$i]->getID();
            $assigneen .= $document->getAssignees()[$i]->getName();

            if ($i != count($document->getAssignees()) - 1) {
                $assignees .= ',';
                $assigneen .= ', ';
            }
        }

        for ($i = 0; $i < count($document->getSigners()); $i++) {
            $signed .= $document->getSigners()[$i]->getName();

            if ($i != count($document->getSigners()) - 1) {
                $signed .= ', ';
            }
        }
        ?>
        <form action="#" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $document->getID() ?>" />
            <input type="hidden" id="assignees" name="assignees" value="<?php echo $assignees ?>" />
            <table>
                <tr>
                    <th><label for="subject">Title:</label></th>
                    <td><input type="text" id="subject" name="subject" value="<?php echo $document->getTitle() ?>" required /></td>
                </tr>
                <tr>
                    <th><label for="clearance">Clearance:</label></th>
                    <td>
                        <select id="clearance" name="clearance">
                            <?php
                            foreach (SecurityClearance::getAllClearances() as $val => $name) {
                                if ($val != 0) {
                                    if ($document->getClearance()->getClearance() == $val)
                                        echo '<option value=' . $val . ' selected>' . $name . '</option>';
                                    else
                                        echo '<option value=' . $val . '>' . $name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="status">Status:</label></th>
                    <td>
                        <select id="status" name="status">
                            <?php
                            foreach (DocStatus::getAllTypes() as $val => $status) {
                                if ($val != 0) {
                                    if ($document->getStatus()->getStatus() == $val)
                                        echo '<option value=' . $val . ' selected>' . $status . '</option>';
                                    else
                                        echo '<option value=' . $val . '>' . $status . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="prefix">Prefix:</label></th>
                    <td>
                        <select id="prefix" name="prefix">
                            <?php
                            foreach (DocPrefix::getAllPrefixes() as $val => $prefix) {
                                if ($val != 0) {
                                    if ($document->getPrefix()->getPrefix() == $val)
                                        echo '<option value=' . $val . ' selected>' . $prefix['name'] . '</option>';
                                    else
                                        echo '<option value=' . $val . '>' . $prefix['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="assign">Add Assignee:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="assign" name="assign">
                            <?php
                            foreach (User::getUsers($_SESSION['user'], true) as $user) {
                                echo '<option value=' . $user->getID() . '>' . $user->getName() . '</option>';
                            }
                            ?>
                        </select> <button id="add" name="submit" class="btn btn-xs btn-default" type="button" onclick="addAssignee();">Add</button> <button id="clear" name="submit" class="btn btn-xs btn-danger" type="button" onclick="clearAssignees();">Clear</button>
                    </td>
                </tr>
                <tr>
                    <th>Assignees:</th>
                    <td id="assigneen"><?php echo $assigneen ?></td>
                </tr>
                <tr>
                    <th>Signed By:</th>
                    <td><?php echo $signed ?></td>
                </tr>
                <tr>
                    <th><label for="body">Text:</label></th>
                    <td><textarea id="body" name="body" rows="7" cols="50"><?php echo $document->getContent() ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="submit" name="submit" class="btn btn-primary" type="button" onclick="editDoc();">Edit</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-primary" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'edit') {
        extract($_POST);
        $document = new Document($_GET['id']);

        /* Mail the new assignees */
        $ids = explode(',', $assignees);
        $users = array();
        for ($i = 0; $i < count($ids); $i++) {
            $users[] = new User($ids[$i]);
        }

        $message = 'You have been assigned to document <b>' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '</b>';
        $subject = 'Document Assignment';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: IR Information Network <irin@eotir.com>" . "\r\n";
        foreach($users as $user) {
            if (!in_array($user, $document->getAssignees())) {
                $to = $user->getEmail();
                //mail($to, $subject, $message, $headers);
                $mail->setFrom('irin@eotir.com', 'IR Information Network');
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;

                if (!$mail->send()) {
                    throw new MailException($mail->ErrorInfo);
                }

                Event::addEvent($user->getName() . ' has been assigned to document ' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '.', $_SESSION['user'], 2);
            }
        }

        Event::addEvent('Document <b>' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '</b> has been modified.', $_SESSION['user'], 2);

        $document->update($subject, $status, $body, $clearance, $prefix, $assignees);
        echo $document->getID();
    }
} else if ($action == 'search') {
    if ($do == 'none') {
        ?>
        <form action="#" method="POST">
            <label for="searchid"><b>ID Number (Including Prefix):</b></label>&nbsp;&nbsp;<input type="text" id="searchid" name="searchid" required/><br/>
            <button id="search" name="search" class="btn btn-primary" type="button" onclick="searchDoc()">Search</button>
        </form>
        <div id="loading" class="alert alert-primary" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'search') {
        $id = substr_replace($_POST['searchid'], '', 0, 1);
        if (!Document::doesExist($id)) {
            echo 'No such document with that ID!';
        } else if (!Document::find($id, $_SESSION['user'])) {
            echo 'You do not have access to this document!';
        } else {
            echo 'true';
        }
    }
} else if ($action == 'new') {
    if ($do == 'none') {
        ?>
        <form action="#" method="POST">
            <input type="hidden" id="assignees" name="assignees" />
            <table>
                <tr>
                    <th><label for="subject">Title:</label></th>
                    <td><input type="text" id="subject" name="subject" required /></td>
                </tr>
                <tr>
                    <th><label for="clearance">Clearance:</label></th>
                    <td>
                        <select id="clearance" name="clearance">
                            <?php
                            foreach (SecurityClearance::getAllClearances() as $val => $name) {
                                if ($val != 0) {
                                    echo '<option value=' . $val . '>' . $name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="prefix">Prefix:</label></th>
                    <td>
                        <select id="prefix" name="prefix">
                            <?php
                            foreach (DocPrefix::getAllPrefixes() as $val => $prefix) {
                                if ($val != 0) {
                                    echo '<option value=' . $val . '>' . $prefix['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="assign">Add Assignee:</label>&nbsp;&nbsp;</th>
                    <td>
                        <select id="assign" name="assign">
                            <?php
                            foreach (User::getUsers($_SESSION['user'], true) as $user) {
                                echo '<option value=' . $user->getID() . '>' . $user->getName() . '</option>';
                            }
                            ?>
                        </select> <button id="add" name="submit" class="btn btn-xs btn-default" type="button" onclick="addAssignee();">Add</button> <button id="clear" name="submit" class="btn btn-xs btn-danger" type="button" onclick="clearAssignees();">Clear</button>
                    </td>
                </tr>
                <tr>
                    <th>Assignees:</th>
                    <td id="assigneen"></td>
                </tr>
                <tr>
                    <th><label for="body">Text:</label></th>
                    <td><textarea id="body" name="body" rows="7" cols="50"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button id="submit" name="submit" class="btn btn-primary" type="button" onclick="createDoc();">Create</button></td>
                </tr>
            </table>
        </form>
        <div id="loading" class="alert alert-primary" role="alert" style="display: none">

        </div>
        <?php
    } else if ($do == 'add') {
        if (isset($_POST['assignees']))
            $assignees = explode(',', $_POST['assignees']);
        else
            $assignees = array();

        if (!in_array($_POST['assign'], $assignees))
            $assignees[] = $_POST['assign'];

        for ($i = 0; $i < count($assignees); $i++) {
            echo (new User($assignees[$i]))->getName();
            if ($i != count($assignees) - 1)
                echo ', ';
        }
    } else if ($do == 'create') {
        extract($_POST);
        $document = Document::create($subject, $body, $clearance, $prefix, $_SESSION['user']->getID(), $assignees);

        /* Mail the new assignees */
        $ids = explode(',', $assignees);
        $users = array();
        for ($i = 0; $i < count($ids); $i++) {
            $users[] = new User($ids[$i]);
        }

        $message = 'You have been assigned to document <b>' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '</b> by <b><i>' . $_SESSION['user']->getName() . '</i></b><br />';
        $message .= 'Login to <a href="http://irin.eotir.com">IRIN</a> to look at the document.';
        $subject = 'Document Assignment';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: IR Information Network <irin@eotir.com>" . "\r\n";
        foreach($users as $user) {
            if (!in_array($user, $document->getAssignees())) {
                $to = $user->getEmail();
                //mail($to, $subject, $message, $headers);
                $mail->setFrom('irin@eotir.com', 'IR Information Network');
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;

                if (!$mail->send()) {
                    throw new MailException($mail->ErrorInfo);
                }

                Event::addEvent($user->getName() . ' has been assigned to document ' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '.', $_SESSION['user'], 2);
            }
        }

        Event::addEvent('Document <b>' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '</b> has been created.', $_SESSION['user'], 1);

        echo $document->getID();
    }
} else if ($action == 'delete') {
    if ($do == 'none') {
        ?>
        <a onclick="load('documents', 'delete', 'delete', {id: '<?php echo $_GET['id'] ?>'})">Continue?</a> (<b>NOTE:</b> This action cannot be reversed!)
        <?php
    } else if ($do == 'delete') {
        $document = new Document($_GET['id']);
        $document->delete();
        Event::addEvent('Document <b>' . $document->getPrefix()->getPrefixAbbrev() . $document->getID() . '</b> has been deleted.', $_SESSION['user'], 3);
        ?>
        <script>
            load('documents', 'view', 'none', {});
        </script>
        <?php
    }
} else if ($action == 'sign') {
    $document = new Document($_GET['id']);
    $document->sign($_SESSION['user']);
    ?>
    <script>
        load('documents', 'view', 'none', {id: '<?php echo $_GET['id'] ?>'});
    </script>
    <?php
}