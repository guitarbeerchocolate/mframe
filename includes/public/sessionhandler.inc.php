<?php
if(!is_null($s->userid))
{
	echo '<li class="active">';
	echo '<a href="formhandler.php?action=sessions/logout">Logout</a>';
	echo '</li>';
}
else
{
	include 'includes/public/navitems.inc.php';
}
?>