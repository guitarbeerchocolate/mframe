<?php
if((isset($_GET['inc'])) && (!empty($_GET['inc'])))
{
  $cfn = $_GET['inc'];
  if(file_exists('includes/manager/'.$_GET['inc'].'.inc.php'))
  {
    $includeFile = 'includes/manager/'.$_GET['inc'].'.inc.php';  
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
  $cfn = 'manager.php';
  $includeFile = 'includes/manager/homepage.inc.php';
}
?>