<?php
$usernameInput = $bs->input('emailaddress', 'Email  address:', 'email');
$detailsInput = $bs->textarea('details', 'Details:');
$fields = array($usernameInput,$detailsInput);
$action = $db->getVal('https_url').'contact/send';
$form = $bs->form($fields,$action,FALSE,'form');
$col = $bs->tag('div',$form,array('class'=>'col-md-12'));
$con = $bs->tag('div',$col,array('class'=>'container'));
$bs->tag('div',$con,array('class'=>'row'));
$bs->render();
?>