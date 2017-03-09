<section class="news">
<h3>News item</h3>
<?php
require_once 'classes/database.class.php';
require_once 'classes/bootstrap.class.php';
$db = new database;
$bs = new bootstrap;
$rows = $db->listorderby('news','created','DESC', 'content');
if(count($rows) > 0)
{
	foreach ($rows as $row)
	{
		$h4 = $bs->tag('h4',$row['name']);
		$header = $bs->tag('header',$h4);
		$content = $row['content'];
		$footerText = 'Created '.date("jS F Y",strtotime($row['created']));
		$footer = $bs->tag('footer',$footerText);
		$bs->tag('article',$header.$content.$footer);
		$bs->render();
	}
}
else
{
	$bs->echop('No existing news');
	$bs->render();
}
?>
</section>