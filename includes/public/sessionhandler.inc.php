<?php
if(!is_null($s->userid))
{
	echo '<li class="active">';
	echo '<a href="formhandler.php?action=sessions/logout">Logout</a>';
	echo '</li>';
	if(in_array($s->userid, $db->getManagers()))
	{
		echo '<li>';
		echo '<a href="manager">Manager options</a>';
		echo '</li>';
	}
}
else
{
	include 'includes/public/navitems.inc.php';
}
?>