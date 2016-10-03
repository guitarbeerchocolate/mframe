<?php
$inc = $db->u->include_to_string('includes/general/homepage-carousel.inc.php');
$col1 = $bs->tag('article','<i class="fa fa-envira" aria-hidden="true"></i>', array('class'=>'col-md-6'));
$col2 = $bs->tag('aside',$inc, array('class'=>'col-md-6'));
$con = $bs->tag(NULL,$col1.$col2,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();

$inc = $db->u->include_to_string('includes/public/sub/news.inc.php');
$col1 = $bs->tag(NULL,$inc, array('class'=>'col-md-6'));
$inc = $db->u->include_to_string('includes/public/sub/twitter.inc.php');
$col2 = $bs->tag(NULL,$inc, array('class'=>'col-md-6'));
$con = $bs->tag(NULL,$col1.$col2,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
?>