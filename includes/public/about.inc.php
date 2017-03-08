<?php
$h2 = $bs->tag('h2','About mframe');
$bs->singleRow(NULL,$h2);
$bs->render();
$p = $bs->tag('p','Best things since sliced bread.');
$bs->singleRow(NULL,$p);
$bs->render();
?>