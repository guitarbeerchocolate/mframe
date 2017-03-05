<?php
if(!is_null($s->userid))
{
	$anchor = $bs->tag('a','Logout',array('href'=>'formhandler.php?action=sessions/logout'));
	$bs->tag('li',$anchor,array('class'=>'active'));
	$bs->render();
	if(in_array($s->userid, $db->getManagers()))
	{
		$anchor = $bs->tag('a','Manager options',array('href'=>'manager'));
		$bs->tag('li',$anchor);
		$bs->render();
	}
}
else
{
	include 'includes/public/navitems.inc.php';
}
?>