<?php
session_start();
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/utilities.class.php';
$u = new utilities;
$settings = parse_ini_file('classes/config.ini', TRUE);
include_once 'includes/manager/urlhandler.inc.php';
$manageridArr = explode(',',$settings['website']['managerids']);
include_once 'includes/manager/sessionhandler.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include_once 'includes/general/meta.inc.php';
    $u->echoeol();
    $u->title($cfn,$settings['website']['name']);
    $u->echoeol();
    include_once 'includes/general/icons.inc.php';
    $u->echoeol();
    include_once 'includes/general/linkrel.inc.php';
    $u->echoeol();
    include_once 'includes/general/tinymce.inc.php';
    $u->echoeol();
    ?>
  </head>
  <body>
  	<?php
    include_once 'includes/general/navigation.inc.php';
    $u->echoeol();
    /* header.inc.php can commonly be commented out
    because include files can contain H2 headers.
    */
    include_once 'includes/general/header.inc.php';
    $u->echoeol();
    include_once 'includes/general/message.inc.php';
    $u->echoeol();
    include_once 'includes/manager/backtoprivate.inc.php';
    $u->echoeol();
    include_once $includeFile;
    $u->echoeol();
    include_once 'includes/general/footer.inc.php';
    ?>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script src="jquery/1.11.2/jquery.min.js"></script>
    <script src="js/datepicker/bootstrap-datepicker.js"></script>
    <script src="js-cache.php"></script>
  </body>
</html>