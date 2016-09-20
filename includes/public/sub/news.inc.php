<h3>News item</h3>
<?php
require_once 'classes/database.class.php';
$db = new database;
$rows = $db->listall('news','content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		echo '<article>';
		echo '<header>';
		echo '<h4>'.$row['name'].'</h4>';
		echo $row['content'];
		echo '<footer>Created '.date("jS F Y",strtotime($row['created'])).'</footer>';
		echo '</header>';
		echo '</article>';
	}
}
else
{
	$db->u->echop('No existing news');
}
?>