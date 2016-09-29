<?php
$h2 = $bs->tag('h2','About mframe');
$header = $bs->column($h2,12,'header');
$hr = $bs->hr();
$con = $bs->container($header.$hr);
$bs->row($con);
$bs->render();
$p = $bs->tag('p','Best things since sliced bread.');
$header = $bs->column($p,12,'article');
$con = $bs->container($header);
$bs->row($con);
$bs->render();
?>