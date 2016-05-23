<div class="col-md-12">
	<h2>News item</h2>
	<?php
	if(isset($_GET['id']))
	{
		require_once 'classes/news.class.php';
		$p = new news;
		$p->getnews($_GET['id']);
		if(isset($p->name))
		{
			echo '<h3>'.$p->name.'</h3>'.PHP_EOL;
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
</div>