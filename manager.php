<?php
session_start();
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/utilities.class.php';
$u = new utilities;
$settings = parse_ini_file('classes/config.ini', TRUE);
$arrStr = explode("/", $_SERVER['SCRIPT_NAME'] ); 
$arrStr = array_reverse($arrStr);
$cfn = $arrStr[0];
$manageridArr = explode(',',$settings['website']['managerids']);
if(!isset($_SESSION['userid']))
{
	$error = urlencode('You must be logged in to access the private section.');
	header('location:'.$settings['website']['formspage'].'?message='.$error);
	exit;
}
else if(!in_array($_SESSION['userid'], $manageridArr))
{
  $error = urlencode('You must be logged in as a manager access the manager section.');
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
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">    
    tinymce.init(
    {
      menubar : false,
      selector: "textarea.tinymce",
      plugins: ["advlist autolink lists hr link code"],  
      toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code | hr | link | ",
      relative_urls: false
    });
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
  				<h2>Manager area</h2>          
  				<a href="private.php?logout=true" class="btn btn-primary">Logout</a>          
  			</div>
        <?php
        if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
        {
          $includeFile = 'includes/manager/'.$_GET['inc'].'.inc.php';
          if(file_exists($includeFile))
          {
            include_once $includeFile;
          }
          else
          {
            $error = urlencode('Include does not exist.');
            header('location:'.$settings['website']['url'].'manager.php?message='.$error);
            exit;
          }
        }
        else
        {
        ?>
        <div class="col-md-12">          
          <a href="manager.php?inc=manageevents">Manage events</a><br />
          <a href="manager.php?inc=managenews">Manage news</a><br />
          <a href="manager.php?inc=managepages">Manage pages</a><br />
          <a href="manager.php?inc=manageprofiles">Manage profiles</a><br />
        </div>
        <?php
        }
        ?>
  		</div><!-- .container -->
  	</div><!-- .row -->
    <script src="jquery/1.11.2/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.form.min.js"></script> -->
    <script src="js-cache.php"></script>
  </body>
</html>