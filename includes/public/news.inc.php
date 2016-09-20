<h2>News item</h2>
<?php
if(isset($_GET['id']))
{
	require_once 'classes/news.class.php';
	$p = new news;
	$p->getnews($_GET['id']);
	if(isset($p->name))
	{
		$u->echoh3($p->name);
		echo $p->content;
	}
	else
	{
		echo 'Not a valid ID';
	}
}
else
{
	echo 'No ID requested';
}
?>