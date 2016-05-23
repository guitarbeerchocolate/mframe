<?php
// include_once 'includes/general/top-cache.php';
include_once 'includes/general/showerrors.inc.php';
require_once 'classes/utilities.class.php';
$u = new utilities;
$settings = parse_ini_file('classes/config.ini', TRUE);
$arrStr = explode("/", $_SERVER['SCRIPT_NAME'] ); 
$arrStr = array_reverse($arrStr);
$cfn = $arrStr[0];
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
    <!--[if lt IE 9]>
      <script src="html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>  	
    <?php
    include_once 'includes/general/googletracker.inc.php';
    $u->echoeol();
    include_once 'includes/general/navigation.inc.php';
    $u->echoeol();
		include_once 'includes/general/header.inc.php';
    $u->echoeol();
    include_once 'includes/general/message.inc.php';
    $u->echoeol();
    if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
    {
      $includeFile = 'includes/public/'.$_GET['inc'].'.inc.php';
      if(file_exists($includeFile))
      {
        include_once $includeFile;
      }
      else
      {
        $error = urlencode('Include does not exist.');
        header('location:'.$settings['website']['url'].'index.php?message='.$error);
        exit;
      }
    }
    else
    {
      include_once 'includes/public/homepage.inc.php';
    }
    ?>
  	<div class="row">  		
  		<div class="container">
      
  		</div><!-- .container -->
  	</div><!-- .row -->
    <?php
    include_once 'includes/general/footer.inc.php';
    ?>
    <script src="jquery/1.11.2/jquery.min.js"></script>    
    <script src="js-cache.php"></script>
  </body>
</html>
<?php
// include_once 'includes/general/bottom-cache.php';
?>