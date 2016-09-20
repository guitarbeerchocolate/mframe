<?php
if(isset($_GET['message']))
{	
	$s = urldecode($_GET['message']);
	$s .= "<script>document.getElementById('message').style.display = 'block';</script>";
	$alert = $bs->alert($s,'warning');
	$col = $bs->column($alert, 12);
	$con = $bs->container($col);
	$bs->row($con);
	$bs->render();
}
?>