<?php
if(!empty($_SESSION))
{
	require_once 'classes/sessions.class.php';
	$sess = new sessions($_SESSION);
	echo '<li class="active">';
	echo '<a href="formhandler.php?action=sessions/logout">Logout</a>';
	echo '</li>';
}
else
{
	include 'includes/public/navitems.inc.php';
}
?>