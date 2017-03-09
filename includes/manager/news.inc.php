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

$action = 'news/deletenews';
$h3 = $bs->tag('h3','Existing news');
$rowArr = array();
$rows = $db->listorderby('news','created','DESC', 'content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$inputStr = '<input type="checkbox" name="id[]" ';
		$inputStr .= 'value="'.$row['id'].'">';
		$editStr = '<a href="manager/news&id='.$row['id'].'">Edit</a>';
		$previewLink = '<a href="news&id='.$row['id'].'" target="_blank">Preview</a>';
		array_push($rowArr, array($inputStr,$row['name'],$editStr,$previewLink));
	}
}
else
{
	array_push($rowArr, array('No existing news'));
}
$table = $bs->table(array('','Name','Action',''),$rowArr);
$form = $bs->form($table, $action);
$bs->singleRow(NULL, $h3.$form);
$bs->render();
?>