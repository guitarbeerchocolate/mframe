<?php
include_once 'includes/general/rss.inc.php';
$bs->echoeol();
include_once 'includes/general/meta.inc.php';
$bs->echoeol();
$bs->title($liveConfig['theTitle'],$liveConfig['name']);
$bs->echoeol();
include_once 'includes/general/icons.inc.php';
$bs->echoeol();
include_once 'includes/general/linkrel.inc.php';
$bs->echoeol();
include_once 'includes/general/tinymce.inc.php';
$bs->echoeol();
include_once 'includes/general/recaptcha.inc.php';
$bs->echoeol();
?>