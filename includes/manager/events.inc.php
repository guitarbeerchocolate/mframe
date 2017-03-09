<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage events');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$row = $db->getOneByID('events',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($this->getVal('url').'manager/events',$error);
	}
	$name = $row['name'];
	$content = $row['content'];
	$datestart = $row['datestart'];
	$dateend = $row['dateend'];
	$action = 'events/updateevents';
}
else
{
	$id = $db->getNextID('events');
	$name = '';
	$content = '';
	$datestart = NULL;
	$dateend = NULL;
	$action = 'events/addevents';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();

$hiddenID = $bs->hiddeninput('id', $id);
$eventName = $bs->input('name','Name of event', NULL, $name);
$startDate = $bs->dateField('datestart','Start date',$datestart);
$endtDate = $bs->dateField('dateend','End date',$dateend);
$pageContent = $bs->textarea('content', 'Page content', $content, $additionalClasses = array('tinymce'), 'content');
$form = $bs->form(array($hiddenID,$eventName,$startDate,$endtDate,$pageContent), $action);
$bs->singleRow(NULL, $form);
$bs->render();
include_once 'uploadedimages.inc.php';

$action = 'events/deleteevents';
$h3 = $bs->tag('h3','Existing events');
$rowArr = array();
$rows = $db->listorderby('events','datestart','DESC', 'content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$editStr = '<a href="manager/events&id='.$row['id'].'">Edit</a>';
		$previewLink = '<a href="events&id='.$row['id'].'" target="_blank">Preview</a>';
		array_push($rowArr, array($inputStr,$row['name'],$editStr,$previewLink));
	}
}
else
{
	array_push($rowArr, array('No existing events'));
}
$table = $bs->table(array('','Name','Action',''),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>
<script src="modules/datepicker/js/bootstrap-datepicker.js"></script>
<script>
	$('.datepicker').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true
	});
</script>