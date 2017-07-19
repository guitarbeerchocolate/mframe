<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage configuration');
if(!is_null($liveConfig['id']))
{
	$id = $liveConfig['id'];
	$row = $db->getOneByID('config',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($liveConfig['url'].'manager/config',$error);
	}
	$name = $row['name'];
	$value = $row['value'];
	$action = 'config/updateitem';
}
else
{
	$id = NULL;
	$name = '';
	$value = '';
	$action = 'config/additem';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();

$hiddenID = $bs->hiddeninput('id', $id);
$itemName = $bs->input('name','Name of item', NULL, $name);
$itemValue = $bs->input('value','Value of item', NULL, $value);
$form = $bs->form(array($hiddenID,$itemName,$itemValue), $action);
$bs->singleRow(NULL, $form);
$bs->render();

$action = 'config/deleteitems';
$h3 = $bs->tag('h3','Existing configuration items');
$rowArr = array();
$rows = $db->listall('config','content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$editStr = '<a href="manager/config&id='.$row['id'].'">Edit</a>';
		array_push($rowArr, array($inputStr,$row['name'],$row['value'],$editStr));
	}
}
else
{
	array_push($rowArr, array('No existing config'));
}
$table = $bs->table(array('','Name','Value','Action'),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>