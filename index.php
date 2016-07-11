<?php
session_start();
// include_once 'includes/general/top-cache.php';
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/config.class.php';
require_once 'classes/utilities.class.php';
$c = new config;
$u = new utilities;
include_once 'includes/general/urlhandler.inc.php';
if($status == 'private')
{
    require_once 'classes/sessions.class.php';
    $sess = new sessions($_SESSION);
    $sess->privateRedirect();
}
elseif($status == 'manager')
{
    require_once 'classes/sessions.class.php';
    $sess = new sessions($_SESSION);
    $sess->managerRedirect();
}
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
    ?>
  </head>
  <body itemscope itemtype="http://schema.org/Organization">
    <?php
    if($status == 'public')
    {
        include_once 'includes/general/googletracker.inc.php';
        $u->echoeol();
    }
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
    $c->getVal('managerids');
    include_once $includeFile;
    $u->echoeol();
    include_once 'includes/general/footer.inc.php';
    ?>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script src="jquery/1.11.2/jquery.min.js"></script>
    <script src="js-cache.php"></script>
  </body>
</html>
<?php
// include_once 'includes/general/bottom-cache.php';
?>