<?php
define('ROOT', realpath(__DIR__ . '/../'));

/* Include Config File */
require_once ROOT . '/lib/config.php';

/*Include Composer Autoloader */
require_once ROOT . '/vendor/autoload.php';

/* Include DB File */
require_once ROOT . '/lib/db.php';

/* Include Mail File */
require_once ROOT . '/lib/mail.php';

/* Include Class Files */
require_once ROOT . '/lib/admin.class.php';
require_once ROOT . '/lib/award.class.php';
require_once ROOT . '/lib/clearance.class.php';
require_once ROOT . '/lib/codegen.class.php';
require_once ROOT . '/lib/devworklog.class.php';
require_once ROOT . '/lib/division.class.php';
require_once ROOT . '/lib/document.class.php';
require_once ROOT . '/lib/documentprefix.class.php';
require_once ROOT . '/lib/documentstatus.class.php';
require_once ROOT . '/lib/errors.class.php';
require_once ROOT . '/lib/event.class.php';
require_once ROOT . '/lib/oath.class.php';
require_once ROOT . '/lib/page.class.php';
require_once ROOT . '/lib/rank.class.php';
require_once ROOT . '/lib/senator.class.php';
require_once ROOT . '/lib/user.class.php';
require_once ROOT . '/lib/version.class.php';
require_once ROOT . '/lib/year.class.php';

/* Include Exception Files */
require_once ROOT . '/lib/exception/dbException.php';
require_once ROOT . '/lib/exception/irinException.php';
require_once ROOT . '/lib/exception/mailException.php';

/* Include Procedureal Files */
require_once ROOT . '/lib/param.php';
require_once ROOT . '/lib/exception/handler.php';

/* Link Configuration */
if ($dev) {
    $awardLink = 'awards/';
} else {
    $awardLink = 'http://eotir.com/awards/';
}

/* Other Setup */
set_exception_handler('exception_handler');
register_shutdown_function("fatal_handler");
if ($dev) {
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(E_ERROR);
}
session_start();

/*$mail->setFrom('test@keshaun.net', 'Testing');
$mail->addAddress('keshaun@eotir.com');
$mail->Subject = 'Testing';
$mail->Body = 'Testing Testing 1 2 3';

if (!$mail->send()) {
    throw new MailException($mail->ErrorInfo);
}*/