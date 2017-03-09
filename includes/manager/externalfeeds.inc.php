<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage feeds');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$row = $db->getOneByID('externalfeeds',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($this->getVal('url').'manager/externalfeeds',$error);
	}
	$name = $row['name'];
	$location = $row['location'];
	$type = $row['type'];
	$action = 'externalfeeds/updateexternalfeed';
}
else
{
	$id = $db->getNextID('externalfeeds');
	$name = '';
	$location = '';
	$type = 1;
	$action = 'externalfeeds/addexternalfeed';
}
$placeHolderText = 'Add URL of the feed';
switch($type)
{
	case 1:
		$placeHolderText = 'Add URL of the feed';
		break;
	case 2:
		$placeHolderText = 'Add twitter username';
		break;
	case 3:
		$placeHolderText = 'Add twitter hashtag';
		break;
	case 4:
		$placeHolderText = 'Add name of channel URL e.g. patcondell';
		break;
	case 5:
		$placeHolderText = 'Add name of pinterest username e.g. mick';
		break;
	default:
		$placeHolderText = 'Add URL of the feed';
		break;
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();

$hiddenID = $bs->hiddeninput('id', $id);
$feedName = $bs->input('name','Name of external feed', NULL, $name);
$radioArr = array(
1 => 'RSS',
2 => 'Twitter user',
3 => 'Twitter hashtag',
4 => 'YouTube channel',
5 => 'Pinterest user'
);
$feedType = $bs->radio('type',$radioArr,$type);
$feed = $bs->input('location','Feed', NULL, $location);
$form = $bs->form(array($hiddenID,$feedName,$feedType,$feed), $action);
$bs->singleRow(NULL, $form);
$bs->render();

$action = 'externalfeeds/deleteexternalfeeds';
$h3 = $bs->tag('h3','Existing external feeds');
$rowArr = array();
$rows = $db->listall('externalfeeds','content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$editStr = '<a href="manager/externalfeeds&id='.$row['id'].'">Edit</a>';
		array_push($rowArr, array($inputStr,$row['name'],$editStr));
	}
}
else
{
	array_push($rowArr, array('No existing external feeds'));
}
$table = $bs->table(array('','Name','Action'),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>