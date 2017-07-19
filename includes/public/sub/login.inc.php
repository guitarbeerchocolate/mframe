<?php
$usernameInput = $bs->input('username', 'Email:', 'email');
$passwordInput = $bs->input('password', 'Password:', 'password');
$fields = array($usernameInput,$passwordInput);
$action = $liveConfig['https_url'].'formhandler.php?action=authenticate/login';
$form = $bs->form($fields,$action,FALSE,NULL);
$panel = $bs->panel($form,'Login');
$bs->tag('div',$panel,array('class'=>'col-md-4 authenticate'));
$bs->render();
?>