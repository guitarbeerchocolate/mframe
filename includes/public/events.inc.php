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
$col = $bs->tag(NULL,$h2.$events,array('class'=>'col-md-12'));	
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
?>