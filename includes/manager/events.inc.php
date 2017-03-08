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
	$datestart = '';
	$dateend = '';
	$action = 'events/addevents';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();

$hiddenID = $bs->hiddeninput('id', $id);
$eventName = $bs->input('name','Name of event', NULL, $name);
$startDate = $bs->input('datestart','Start date', 'date', $datestart);
$endtDate = $bs->input('dateend','End date', 'date', $datestart);
$pageContent = $bs->textarea('content', 'Page content', $content, $additionalClasses = array('tinymce'), 'content');
$form = $bs->form(array($hiddenID,$eventName,$startDate,$endtDate,$pageContent), $action);
$bs->singleRow(NULL, $form);
$bs->render();
include_once 'uploadedimages.inc.php';
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Existing events</h3>
			<form method="post" action="events/deleteevents" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td><td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listorderby('events','created','DESC', 'content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/events&id='.$row['id'].'">Edit</a>';
							$previewLink = '<a href="events&id='.$row['id'].'" target="_blank">Preview</a>';
							$db->u->echotr(array($inputStr,$row['name'],$editStr,$previewLink));
						}
					}
					else
					{
						$db->u->echotr(array('No existing events'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>