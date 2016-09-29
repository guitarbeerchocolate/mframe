<?php
$h2 = $bs->tag('h2','Contact');
$input = $bs->input('emailaddress', 'Email address');
$textarea = $bs->textarea('details', 'Details');
$inputArr = array($input, $textarea);
$form  = $bs->form($inputArr, 'contact/send', FALSE, 'form');
$col = $bs->column($h2.$form);
$con = $bs->container($col);
$bs->row($con);
$bs->render();
?>