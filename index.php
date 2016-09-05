<?php
session_start();
date_default_timezone_set("Europe/London");
/* include_once 'includes/general/top-cache.php'; */
include_once 'includes/general/showerrors.inc.php';
$liveConfig = array();
require_once 'classes/sessions.class.php';
require_once 'classes/database.class.php';
$db = new database;
include_once 'includes/general/loginhandler.inc.php';
$s = new sessions($_SESSION);
include_once 'includes/general/urlhandler.inc.php';
include_once 'includes/general/userlevelhandler.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include_once 'includes/general/meta.inc.php';
    $db->u->echoeol();
    $db->u->title($liveConfig['theTitle'],$db->getVal('name'));
    $db->u->echoeol();
    include_once 'includes/general/icons.inc.php';
    $db->u->echoeol();
    include_once 'includes/general/linkrel.inc.php';
    $db->u->echoeol();
    include_once 'includes/general/tinymce.inc.php';
    ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body itemscope itemtype="http://schema.org/Organization">
    <?php
    include_once 'includes/general/googletracker.inc.php';
    $db->u->echoeol();    
    include_once 'includes/general/navigation.inc.php';
    $db->u->echoeol();
    include_once 'includes/general/message.inc.php';
    $db->u->echoeol();
    if(isset($_GET['searchterms']))
    { 
        include_once 'includes/general/searchresults.inc.php';
        $db->u->echoeol(); 
    }
    else
    {
        include_once $liveConfig['includeFile'];
    }
    $db->u->echoeol();
    include_once 'includes/general/footer.inc.php';
    $db->u->echoeol();
    include_once 'includes/general/script.inc.php';
    ?>    
  </body>
</html>
<?php
/* include_once 'includes/general/bottom-cache.php'; */
?>