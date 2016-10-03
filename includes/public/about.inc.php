<?php
$h2 = $bs->tag('h2','About mframe');
$col = $bs->tag(NULL,$h2,array('class'=>'col-md-12'));
$hr = $bs->tag('hr');
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con.$hr,array('class'=>'row'));
$bs->render();

$p = $bs->tag('p','Best things since sliced bread.');
$col = $bs->tag('article',$p,array('class'=>'col-md-12'));
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
?>