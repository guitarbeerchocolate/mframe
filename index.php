<?php
session_start();
// include_once 'includes/general/top-cache.php';
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/sessions.class.php';
require_once 'classes/config.class.php';
require_once 'classes/utilities.class.php';
$s = new sessions($_SESSION);
$c = new config;
$u = new utilities;
include_once 'includes/general/urlhandler.inc.php';
include_once 'includes/general/userlevelhandler.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include_once 'includes/general/meta.inc.php';
    $u->echoeol();
    $u->title($status,$c->getVal('name'));
    $u->echoeol();
    include_once 'includes/general/icons.inc.php';
    $u->echoeol();
    include_once 'includes/general/linkrel.inc.php';
    $u->echoeol();
    include_once 'includes/general/tinymce.inc.php';
    ?>
  </head>
  <body itemscope itemtype="http://schema.org/Organization">
    <?php
    include_once 'includes/general/googletracker.inc.php';
    $u->echoeol();    
    include_once 'includes/general/navigation.inc.php';
    $u->echoeol();
    /* header.inc.php can commonly be commented out
    because include files can contain H2 headers.
    */
    /*
    include_once 'includes/general/header.inc.php';
    $u->echoeol();
    */
    include_once 'includes/general/message.inc.php';
    $u->echoeol();
    include_once 'includes/general/searchresults.inc.php';
    $u->echoeol();    
    include_once $includeFile;
    $u->echoeol();
    include_once 'includes/general/footer.inc.php';
    $u->echoeol();
    include_once 'includes/general/script.inc.php';
    ?>    
  </body>
</html>
<?php
// include_once 'includes/general/bottom-cache.php';
?>