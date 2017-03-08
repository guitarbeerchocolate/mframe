<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage configuration');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$row = $db->getOneByID('config',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($this->getVal('url').'manager/config',$error);
	}
	$name = $row['name'];
	$value = $row['value'];
	$action = 'config/updateitem';
}
else
{
	$id = $db->getNextID('config');
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
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Existing configuration items</h3>
			<form method="post" action="config/deleteconfig" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Value</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('config','content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/config&id='.$row['id'].'">Edit</a>';
							$db->u->echotr(array($inputStr,$row['name'],$row['value'],$editStr));
						}
					}
					else
					{
						$db->u->echotr(array('No existing config'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>