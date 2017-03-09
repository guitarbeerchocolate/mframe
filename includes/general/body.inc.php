<?php
include_once 'includes/general/googletracker.inc.php';
$bs->echoeol();
include_once 'includes/general/navigation.inc.php';
$bs->echoeol();
include_once 'includes/general/message.inc.php';
if(array_key_exists('searchterms',$_GET))
{
    include_once 'includes/general/searchresults.inc.php';
    $bs->echoeol();
}
else
{
    include_once $liveConfig['includeFile'];
}
$bs->echoeol();
include_once 'includes/general/footer.inc.php';
$bs->echoeol();
include_once 'includes/general/script.inc.php';
?>