<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once 'classes/database.class.php';
$db = new database;
$query = '';
if(isset($_GET['query']))
{
	$query = "%".urldecode($_GET['query'])."%";
	$rows = $db->searchBynames('pages','name',$query);
}
else
{
	$rows = $db->performquery("SELECT name FROM pages");
}
$newArr = array();
foreach ($rows as $row)
{
	array_push($newArr, $row['name']);
}
?>
{
    "query": "Unit",
    "suggestions":<?php echo json_encode($newArr);?>
}