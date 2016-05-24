<?php
if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
{
  $cfn = $_GET['inc'];
  if(file_exists('includes/public/'.$_GET['inc'].'.inc.php'))
  {
    $includeFile = 'includes/public/'.$_GET['inc'].'.inc.php';  
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
  $cfn = 'index.php';
  $includeFile = 'includes/public/homepage.inc.php';
}
?>