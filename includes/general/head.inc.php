<?php
include_once 'includes/general/meta.inc.php';
$bs->echoeol();
$bs->title($liveConfig['theTitle'],$db->getVal('name'));
$bs->echoeol();
include_once 'includes/general/icons.inc.php';
$bs->echoeol();
include_once 'includes/general/linkrel.inc.php';
$bs->echoeol();
include_once 'includes/general/tinymce.inc.php';
?>
<script src='https://www.google.com/recaptcha/api.js'></script>