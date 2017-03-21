<?php
include_once 'includes/general/showerrors.inc.php';
include_once 'includes/general/exceptions.inc.php';
include_once 'includes/general/liveconfig.inc.php';
require_once 'classes/sessions.class.php';
require_once 'classes/database.class.php';
$db = new database;
include_once 'includes/general/loginhandler.inc.php';
$s = new sessions($_SESSION);
include_once 'includes/general/urlhandler.inc.php';
include_once 'includes/general/userlevelhandler.inc.php';
require_once 'classes/bootstrap.class.php';
$bs = new bootstrap;
?>