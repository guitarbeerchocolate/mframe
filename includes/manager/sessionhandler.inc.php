<?php
require_once 'classes/sessions.class.php';
$sess = new sessions($_SESSION);
$sess->managerRedirect($settings, $manageridArr);
?>