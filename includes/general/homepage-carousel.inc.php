<?php
require_once 'classes/bootstrap.class.php';
$bs = new bootstrap;
$imgArr = array(
'img/largelogoCC3333.png',
'img/largelogo1F7A7A.png',
'img/largelogo8FBE30.png'
);
$bs->carousel($imgArr);
$bs->render();
?>