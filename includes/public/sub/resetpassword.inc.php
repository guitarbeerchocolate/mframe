<?php
$usernameInput = $bs->input('username', 'Email:', 'email', $_GET['username']);
$passwordInput = $bs->input('password', 'New password:', 'password');
$fields = array($usernameInput,$passwordInput);
$action = $db->getVal('https_url').'formhandler.php?action=authenticate/resetpassword';
$form = $bs->form($fields,$action,FALSE,NULL);
$panel = $bs->panel($form,'Reset password');
$bs->tag('div',$panel,array('class'=>'col-md-4'));
$bs->render();
?>