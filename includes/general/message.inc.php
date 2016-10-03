<?php
if(isset($_GET['message']))
{	
	$s = urldecode($_GET['message']);
	$s .= "<script>document.getElementById('message').style.display = 'block';</script>";
	$alert = $bs->tag(NULL,$s,array('class'=>array('alert', 'alert-warning'),'role'=>'alert'));
	$col = $bs->tag(NULL,$alert,array('class'=>'col-md-12'));	
	$con = $bs->tag(NULL,$col,array('class'=>'container'));
	$bs->tag(NULL,$con,array('class'=>'row'));
	$bs->render();
}
?>