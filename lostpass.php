<?php
require_once('lib/path.php');
if ($down) {
    header('Location: index.php');
} else if (isset($_SESSION['user'])) {
    header("Location: main.php");
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Imperial Republic Information Network</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="css/cover.css" type="text/css" rel="stylesheet" />
        <link href="css/signin.css" type="text/css" rel="stylesheet" />
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/lostpass.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand">Imperial Republic Information Network</h3>
                    </div>
                </div>
                <div class="inner cover">
                    <h1 class="cover-heading">Login</h1>
                    <form class="form-signin" action="#" method="post">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus />
                        <button id="submit" name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Request</button>
                    </form>
                    <div id="error" class="alert alert-danger" role="alert">

                    </div>
                </div>
                <div class="mastfoot">
                    <div class="inner">
                        <p>&copy; Copyright <a href="http://www.eotir.com/" target="_blank">Era of the Imperial Republic RPG</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}