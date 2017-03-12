<?php
$h3 = $bs->tag('h3','Your profile');
$row = $db->getOneByFieldValue('profiles','userid',$s->userid);
$h4 = NULL;
$img = NULL;
if($row == TRUE)
{
	$name = $row['name'];
	$content = $row['content'];
	$photo = $row['photo'];
	$h4 = $bs->tag('h4',$name);
	if(!empty($photo))
	{
		$img = $bs->img($photo);
	}
	$action = 'profiles/updateprofiles';
}
else
{
	$name = '';
	$content = '';
	$photo = '';
	$action = 'profiles/addprofiles';
}
$bs->singleRow(NULL, $h3.$h4.$content.$img);
$bs->render();
include 'sub/profileform.inc.php';
?>