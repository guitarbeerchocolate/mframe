<?php
if($status == 'private')
{
    require_once 'classes/sessions.class.php';
    $sess = new sessions($_SESSION);
    $sess->privateRedirect();
}
elseif($status == 'manager')
{
    require_once 'classes/sessions.class.php';
    $sess = new sessions($_SESSION);
    $sess->managerRedirect();
}
?>