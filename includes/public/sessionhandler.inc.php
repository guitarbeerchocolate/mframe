<?php
if(isset($_SESSION))
{
	require_once 'classes/sessions.class.php';
	$sess = new sessions($_SESSION);
	echo '<li class="active"><a href="index.php?logout=true">Logout</a></li>';
}
else
{
	include 'includes/public/navitems.inc.php';
}
?>