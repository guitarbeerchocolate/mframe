<?php
$h2 = $bs->tag('h2','Contact');
$input = $bs->input('emailaddress', 'Email address');
$textarea = $bs->textarea('details', 'Details');
$inputArr = array($input, $textarea);
$form  = $bs->form($inputArr, 'contact/send', FALSE, 'form');
$col = $bs->tag(NULL,$h2.$form,array('class'=>'col-md-12'));	
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
?>