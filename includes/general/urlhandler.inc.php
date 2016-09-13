<?php
$liveConfig['status'] = 'public';
$liveConfig['includeFile'] = 'includes/';
$liveConfig['parameterName'] = NULL;
$liveConfig['parameterValue'] = NULL;
$liveConfig['hasInclude'] = FALSE;
$liveConfig['theTitle'] = NULL;
$liveConfig['paramArr'] = array();

if((isset($_GET['searchterms'])) && (!empty($_GET['searchterms'])))
{
  $liveConfig['theTitle'] = 'Search';
}
if((isset($_GET['params'])) && (!empty($_GET['params'])))
{
  $liveConfig['paramArr'] = explode('/', $_GET['params']);
  $liveConfig['theTitle'] =$liveConfig['paramArr'][0];
  switch(count($liveConfig['paramArr']))
  {
    case 0:
      $liveConfig['includeFile'] .= 'public/homepage.inc.php'; 
      break;
    case 1:
      if(($liveConfig['paramArr'][0] == 'private') || ($liveConfig['paramArr'][0] == 'manager'))
      {
        $liveConfig['status'] = $liveConfig['paramArr'][0];
        $liveConfig['includeFile'] .= $liveConfig['status'].'/homepage.inc.php';
      }
      else
      {
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][0].'.inc.php';
        $liveConfig['hasInclude'] = TRUE;
      }
      break;
    case 2:
      if(($liveConfig['paramArr'][0] == 'private') || ($liveConfig['paramArr'][0] == 'manager'))
      {
        $liveConfig['status'] = $liveConfig['paramArr'][0];
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][1].'.inc.php';
        $liveConfig['hasInclude'] = TRUE;
      }
      else
      {
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][0].'.inc.php';
        $liveConfig['parameterName'] = $liveConfig['paramArr'][1];
        $liveConfig['hasInclude'] = TRUE;
      }
      break;
    case 3:
      if(($liveConfig['paramArr'][0] == 'private') || ($liveConfig['paramArr'][0] == 'manager'))
      {
        $liveConfig['status'] = $liveConfig['paramArr'][0];
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][1].'.inc.php';
        $liveConfig['parameterName'] = $liveConfig['paramArr'][2];
        $liveConfig['hasInclude'] = TRUE;
      }
      else
      {
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][0].'.inc.php';
        $liveConfig['parameterName'] = $liveConfig['paramArr'][1];
        $liveConfig['parameterValue'] = $liveConfig['paramArr'][2];
        $liveConfig['hasInclude'] = TRUE;
      }
      break;
    case 4:
      if(($liveConfig['paramArr'][0] == 'private') || ($liveConfig['paramArr'][0] == 'manager'))
      {
        $liveConfig['status'] = $liveConfig['paramArr'][0];
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][1].'.inc.php';
        $liveConfig['parameterName'] = $liveConfig['paramArr'][2];
        $liveConfig['parameterValue'] = $liveConfig['paramArr'][3];
        $liveConfig['hasInclude'] = TRUE;
      }
      else
      {
        $liveConfig['includeFile'] .= $liveConfig['status'].'/'.$liveConfig['paramArr'][0].'.inc.php';
        $liveConfig['parameterName'] = $liveConfig['paramArr'][1];
        $liveConfig['parameterValue'] = $liveConfig['paramArr'][2];
        $liveConfig['hasInclude'] = TRUE;
      }
      break;
    default:
      $liveConfig['includeFile'] .= 'public/homepage.inc.php';
      break;
  }  
}
else
{
  $liveConfig['includeFile'] .= 'public/homepage.inc.php'; 
}

$liveConfig['theDescription'] = $db->getVal('meta_description');

if(($liveConfig['theTitle'] == 'service') && (isset($_GET['id'])))
{
  $id = $_GET['id'];
  $titleRow = $db->getOneByID($liveConfig['theTitle'],$id);
  $liveConfig['theTitle'] = $titleRow['name'];

  if(strlen($titleRow['description']) < 150)
  {
    $positionOfLastFullStop = strrpos($titleRow['description'],'.');
    $liveConfig['theDescription'] = substr($titleRow['description'], 0, $positionOfLastFullStop);
  }
  else
  {
    $liveConfig['theDescription'] = $titleRow['description'];
  }
}

if(!file_exists($liveConfig['includeFile']))
{
  $error = 'Include does not exist.';
  $db->u->move_on($db->getVal('url'),$error);
}