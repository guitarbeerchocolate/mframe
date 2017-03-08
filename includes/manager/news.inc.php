<?php
$back = $bs->buttonLink('Back', 'manager');
$h2 = $bs->tag('h2','Manage news');
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$row = $db->getOneByID('news',$id,'content');
	if(!isset($row['id']))
	{
		$error = 'The ID does not exist';
		$db->u->move_on($this->getVal('url').'manager/news',$error);
	}
	$name = $row['name'];
	$content = $row['content'];
	$action = 'news/updatenews';
}
else
{
	$id = $db->getNextID('news');
	$name = '';
	$content = '';
	$action = 'news/addnews';
}
$bs->singleRow(NULL, $back.$h2);
$bs->render();

$hiddenID = $bs->hiddeninput('id', $id);
$newsName = $bs->input('name','Name of news', NULL, $name);
$pageContent = $bs->textarea('content', 'Page content', $content, $additionalClasses = array('tinymce'), 'content');
$form = $bs->form(array($hiddenID,$newsName,$pageContent), $action);
$bs->singleRow(NULL, $form);
$bs->render();
include_once 'uploadedimages.inc.php';
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Existing news</h3>
			<form method="post" action="news/deletenews" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td><td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listorderby('news','created','DESC', 'content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/news&id='.$row['id'].'">Edit</a>';
							$previewLink = '<a href="news&id='.$row['id'].'" target="_blank">Preview</a>';
							$db->u->echotr(array($inputStr,$row['name'],$editStr,$previewLink));
						}
					}
					else
					{
						$db->u->echotr(array('No existing news'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>