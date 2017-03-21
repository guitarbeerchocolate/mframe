<?php
if(!is_null($liveConfig['id']))
{
	$error = FALSE;
	$p = $pages->getdata($liveConfig['id']);
}
else
{
	$h3 = 'Error';
	$content = '<p>No ID requested</p>';
	$error = TRUE;
}
if(isset($p['name']))
{
    $h3 = $p['name'];
    $content = $p['content'];
}
else
{
    $h3 = 'Error';
    $content = '<p>Not a valid ID</p>';
    $error = TRUE;
}
if(isset($p['secondarycontent']))
{
	if(($p['secondarycontent'] != NULL) || ($p['secondarycontent'] != ''))
	{
	    $secondarycontent = $p['secondarycontent'];
	}
	else
	{
	    $secondarycontent = 'Secondary content not set';
	}
}
$sc = FALSE;
$s3 = NULL;
if(isset($secondarycontent))
{
	if((is_numeric($secondarycontent)) && ($secondarycontent != 0))
	{
		$sp = $pages->getdata($secondarycontent);
		$sc = TRUE;
	}
}
if(($error == TRUE) || ($p['layout'] == 1) || ($p['layout'] == 0))
{
	$headName = $bs->tag('h3',$h3);
	$header = $bs->tag('header',$headName);
	$bs->singleRow(NULL, $header.$content);
	$bs->render();
}
elseif($p->layout == 2)
{
	$headName = $bs->tag('h3',$h3);
	$header = $bs->tag('header',$headName);
	$s1 = $header.$content;
	if($sc == TRUE)
	{
		$headName = $bs->tag('h3',$sp['name']);
		$header = $bs->tag('header',$headName);
		$s2 = $header.$sp['content'];
	}
	else
	{
		$s2 = $db->u->include_to_string($secondarycontent);
	}
	$bs->twoHalves(NULL, $s1, $s2);
	$bs->render();
}
elseif($p['layout'] == 3)
{
	$headName = $bs->tag('h3',$h3);
	$header = $bs->tag('header',$headName);
	$s1 = $header.$content;
	if($sc == TRUE)
	{
		 $headName = $bs->tag('h3',$sp['name']);
	                $header = $bs->tag('header',$headName);
	                $s2 = $header.$sp['content'];
	}
	else
	{
		$s3 = $db->u->include_to_string($secondarycontent);
	}
	$bs->threeThirds(NULL, $s1, $s2, $s3);
	$bs->render();
}
?>