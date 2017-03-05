<?php
$useridInput = $bs->hiddeninput('userid', $s->userid);
$nameInput = $bs->input('name', 'Your name', 'text', $name);
$contentInput = $bs->textarea('content', 'About you', $content, NULL, 'content');
$photoInput = $bs->input('photo', 'Chosen photo', 'file', NULL,'photo');
$fields = array($useridInput,$nameInput,$contentInput,$photoInput);
$bs->form($fields,$action,TRUE,'form');
$bs->render();
?>