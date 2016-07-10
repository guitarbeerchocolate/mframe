<?php
$status = 'public';
$includeFile = 'includes/';
$parameterName = NULL;
$parameterValue = NULL;
$hasInclude = FALSE;
if((isset($_GET['params'])) && (!empty($_GET['params'])))
{
  $paramArr = explode('/', $_GET['params']);
  switch(count($paramArr))
  {
    case 0:
      $includeFile .= 'public/homepage.inc.php'; 
      break;
    case 1:
      if(($paramArr[0] == 'private') || ($paramArr[0] == 'manager'))
      {
        $status = $paramArr[0];
      }
      else
      {
        $includeFile .= $status.'/'.$paramArr[0].'.inc.php';
        $hasInclude = TRUE;
      }
      break;
    case 2:
      if(($paramArr[0] == 'private') || ($paramArr[0] == 'manager'))
      {
        $status = $paramArr[0];
        $includeFile .= $status.'/'.$paramArr[1].'.inc.php';
        $hasInclude = TRUE;
      }
      else
      {
        $includeFile .= $status.'/'.$paramArr[0].'.inc.php';
        $parameterName = $paramArr[1];
        $hasInclude = TRUE;
      }
      break;
    case 3:
      if(($paramArr[0] == 'private') || ($paramArr[0] == 'manager'))
      {
        $status = $paramArr[0];
        $includeFile .= $status.'/'.$paramArr[1].'.inc.php';
        $parameterName = $paramArr[2];
        $hasInclude = TRUE;
      }
      else
      {
        $includeFile .= $status.'/'.$paramArr[0].'.inc.php';
        $parameterName = $paramArr[1];
        $parameterValue = $paramArr[2];
        $hasInclude = TRUE;
      }
      break;
    case 4:
      if(($paramArr[0] == 'private') || ($paramArr[0] == 'manager'))
      {
        $status = $paramArr[0];
        $includeFile .= $status.'/'.$paramArr[1].'.inc.php';
        $parameterName = $paramArr[2];
        $parameterValue = $paramArr[3];
        $hasInclude = TRUE;
      }
      else
      {
        $includeFile .= $status.'/'.$paramArr[0].'.inc.php';
        $parameterName = $paramArr[1];
        $parameterValue = $paramArr[2];
        $hasInclude = TRUE;
      }
      break;
    default:
      $includeFile .= 'public/homepage.inc.php';      
      break;
  }  
}
else
{
  $includeFile .= 'public/homepage.inc.php'; 
}

if(!file_exists($includeFile))
{
  $error = urlencode('Include does not exist.');
  header('location:'.$settings['website']['url'].'?message='.$error);
  exit;
}

if((isset($_POST)) && (!empty($_POST)))
{
  echo 'There is a POST array';
  print_r($_POST);
}