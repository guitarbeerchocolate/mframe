<?php
$h2 = $bs->tag('h2','Events');
$eventStr = '';
if(!is_null($liveConfig['id']))
{
	$e = $events->getdata($liveConfig['id']);
	if(isset($e['name']))
	{
		$header = $bs->tag('h3',$e['name']);
		$dates = $bs->tag('strong','From '.date("jS F Y",strtotime($e['datestart'])).' to '.date("jS F Y",strtotime($e['dateend'])));
		$dates = $bs->tag('p',$dates);
		$eventStr .= $header.$dates.$e['content'];
	}
	else
	{
		$eventStr = $bs->tag('p','Not a valid ID');
	}
}
else
{
	$eventStr = $bs->tag('p','No ID requested');
}
$bs->singleRow(NULL,$h2.$eventStr);
$bs->render();
?>