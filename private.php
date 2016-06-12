<?php
session_start();
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/utilities.class.php';
$u = new utilities;
$settings = parse_ini_file('classes/config.ini', TRUE);
include_once 'includes/private/urlhandler.inc.php';
if(!isset($_SESSION['userid']))
{
	$error = urlencode('You must be logged in to access the private section.');
	header('location:'.$settings['website']['formspage'].'?message='.$error);
	exit;
}
else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
{
	unset($_SESSION['userid']);
	session_destroy();
	$error = urlencode('Logged out.');
	header('location:'.$settings['website']['formspage'].'?message='.$error);
	exit;
}
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
    include_once 'includes/general/header.inc.php';
    $u->echoeol();
    include_once 'includes/general/message.inc.php';
    $u->echoeol();
    include_once 'includes/private/logout.inc.php';
    $u->echoeol();
    include_once $includeFile;
    $u->echoeol();
    include_once 'includes/general/footer.inc.php';
    ?>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script src="jquery/1.11.2/jquery.min.js"></script>
    <script src="js-cache.php"></script>
  </body>
</html>