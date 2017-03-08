<?php
$inc = $db->u->include_to_string('includes/general/homepage-carousel.inc.php');
$col1 = '<i class="fa fa-envira" aria-hidden="true"></i>';
$bs->twoHalves(NULL,$col1, $inc);
$bs->render();
$news = $db->u->include_to_string('includes/public/sub/news.inc.php');
$twitter = $db->u->include_to_string('includes/public/sub/twitter.inc.php');
$bs->twoHalves(NULL,$news, $twitter);
$bs->render();
?>