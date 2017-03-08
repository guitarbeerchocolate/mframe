<?php
$nitems = $db->listall('navigation');
foreach ($nitems as $nitem)
{
    echo '<li><a href="'.$nitem['location'].'">'.$nitem['name'].'</a></li>'.PHP_EOL;
}
?>