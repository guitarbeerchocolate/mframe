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
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h4>Existing external feeds</h4>
			<form method="post" action="externalfeeds/deleteexternalfeeds" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('externalfeeds','content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/externalfeeds&id='.$row['id'].'">Edit</a>';
							$db->u->echotr(array($inputStr,$row['name'],$editStr));
						}
					}
					else
					{
						$db->u->echotr(array('No existing external feeds'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>