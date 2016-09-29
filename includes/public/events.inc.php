<?php
$h2 = $bs->tag('h2','Events');
$events = '';
if(isset($_GET['id']))
{
	require_once 'classes/events.class.php';
	$p = new events;
	$p->getevents($_GET['id']);
	if(isset($p->name))
	{
		$header = $bs->tag('h3',$p->name);
		$dates = $bs->tag('strong','From '.date("jS F Y",strtotime($p->datestart)).' to '.date("jS F Y",strtotime($p->dateend)));
		$dates = $bs->tag('p',$dates);
		$events .= $header.$dates.$p->content;
	}
	else
	{
		$events = $bs->tag('p','Not a valid ID');
	}
}
else
{
	$events = $bs->tag('p','No ID requested');
}
$col = $bs->column($h2.$events);
$con = $bs->container($col);
$bs->row($con);
$bs->render();
?>