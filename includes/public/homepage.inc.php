<?php
$inc = $db->u->include_to_string('includes/general/homepage-carousel.inc.php');
$col1 = $bs->column('<i class="fa fa-envira" aria-hidden="true"></i>', 6,'article');
$col2 = $bs->column($inc, 6,'aside');
$con = $bs->container($col1.$col2);
$bs->row($con);
$bs->render();
$inc = $db->u->include_to_string('includes/public/sub/news.inc.php');
$col1 = $bs->column($inc, 6);
$inc = $db->u->include_to_string('includes/public/sub/twitter.inc.php');
$col2 = $bs->column($inc, 6);
$con = $bs->container($col1.$col2);
$bs->row($con);
$bs->render();
?>