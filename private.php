<?php
session_start();
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/utilities.class.php';
$u = new utilities;
$settings = parse_ini_file('classes/config.ini', TRUE);
$arrStr = explode("/", $_SERVER['SCRIPT_NAME'] ); 
$arrStr = array_reverse($arrStr);
$cfn = $arrStr[0];
if(!isset($_SESSION['userid']))
{
	$error = urlencode('You must be logged in to access the private section.');
	header('location:'.$settings['website']['formspage'].'?message='.$error);
	exit;
}
else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
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
    ?>
    <base href="<?php echo $settings['website']['url'].$cfn; ?>">
    <link rel="canonical" href="<?php echo $settings['website']['url'].$cfn; ?>" />
    <link type="text/plain" rel="author" href="<?php echo $settings['website']['url']; ?>humans.txt" />
    <link rel="alternate" type="text/directory" title="vCard" href="vcard.vcf" />
    <link href="http://fonts.googleapis.com/css?family=Raleway|Open+Sans:400,400italic,700italic,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css-cache.php" />    
    <script type="text/javascript">
    /*
    tinymce.init(
    {
      selector: "textarea.tinymce"
    });
    */
    </script>
    <!--[if lt IE 9]>
      <script src="html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="row">
  		<div class="container">
  			<?php
        include_once 'includes/general/message.inc.php';
        ?>
  			<div class="col-md-12">
  				<h2>This is the private area</h2>          
  				<a href="private.php?logout=true" class="btn btn-primary">Logout</a>
          <?php
          $manageridArr = explode(',',$settings['website']['managerids']);
          if(in_array($_SESSION['userid'], $manageridArr))
          {
            $u->brecho('<a href="manager.php">Go to the manager options</a>');
          }
          ?>
  			</div>
        <?php
        if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
        {
          $includeFile = 'includes/private/'.$_GET['inc'].'.inc.php';
          if(file_exists($includeFile))
          {
            include_once $includeFile;
          }
          else
          {
            $error = urlencode('Include does not exist.');
            header('location:'.$settings['website']['url'].'private.php?message='.$error);
            exit;
          }
        }
        ?>
  		</div><!-- .container -->
  	</div><!-- .row -->
    <script src="jquery/1.11.2/jquery.min.js"></script>
    <script src="js-cache.php"></script>
  </body>
</html>