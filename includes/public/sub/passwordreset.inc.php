<?php
$usernameInput = $bs->input('username', 'Email:', 'email');
$fields = array($usernameInput);
$action = $liveConfig['https_url'].'formhandler.php?action=authenticate/passwordresetrequest';
$form = $bs->form($fields,$action,FALSE,NULL);
$panel = $bs->panel($form,'Password reset');
$bs->tag('div',$panel,array('class'=>'col-md-4 authenticate'));
$bs->render();
?>