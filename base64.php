<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once 'classes/database.class.php';
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$db = new database;
	$service = $db->getOneByID('service',$id);
	echo $service['photo'];
}
?>