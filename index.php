<?php
session_start();
date_default_timezone_set("Europe/London");
/* include_once 'includes/general/top-cache.php'; */
include_once 'includes/general/setup.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include_once 'includes/general/head.inc.php';
?>
</head>
<body itemscope itemtype="http://schema.org/Organization">
<?php
// print_r($liveConfig);
include_once 'includes/general/body.inc.php';
?>
</body>
</html>
<?php
/* include_once 'includes/general/bottom-cache.php'; */
?>