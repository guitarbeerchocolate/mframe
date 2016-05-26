<?php
if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
{
  $cfn = $_GET['inc'];
  if(file_exists('includes/private/'.$_GET['inc'].'.inc.php'))
  {
    $includeFile = 'includes/private/'.$_GET['inc'].'.inc.php';  
  }
  else
  {
    $error = urlencode('Include does not exist.');
    header('location:'.$settings['website']['url'].'private.php?message='.$error);
    exit;
  }
}
else
{
  $cfn = 'private.php';
  $includeFile = 'includes/private/homepage.inc.php';
}
?>