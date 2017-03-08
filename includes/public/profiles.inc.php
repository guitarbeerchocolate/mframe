<?php
$rows = $db->listall('profiles','content');
$pf = $bs->tag('h2','Profiles');
foreach ($rows as $row)
{
	$profileImg = $bs->tag('img',NULL,array('class'=>'img-responsive','src'=>$row['photo'],'alt'=>$row['name']));
	$h4 = $bs->tag('h4',$row['name']);
	$content = $h4.$profileImg.strip_tags($row['content']);
	$pf .= $bs->tag('article',$content,array('class'=>'publicprofiles'));
}
$bs->singleRow(NULL, $pf);
$bs->render();
?>