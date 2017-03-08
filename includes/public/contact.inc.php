<?php
$usernameInput = $bs->input('emailaddress', 'Email  address:', 'email');
$detailsInput = $bs->textarea('details', 'Details:');
$fields = array($usernameInput,$detailsInput);
$action = $db->getVal('https_url').'contact/send';
$form = $bs->form($fields,$action,FALSE,'form');
$bs->singleRow(NULL,$form);
$bs->render();
?>