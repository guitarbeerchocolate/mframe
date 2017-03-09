<?php
$back = $bs->buttonLink('Back', 'manager');
$action = 'profiles/deleteprofiles';
$h3 = $bs->tag('h3','Manage profiles');
$rowArr = array();
$rows = $db->listall('profiles','content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$bs->echotr(array($inputStr,$row['name']));
		array_push($rowArr, array($inputStr,$row['name']));
	}
}
else
{
	array_push($rowArr, array('No existing profiles'));
}
$table = $bs->table(array('','Name'),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $back.$h3.$form);
$bs->render();
?>