<div class="row">
	<div class="container">
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
				$db->u->echoheader(3,$p->name);
				$db->u->echop($p->content);
			}
			else
			{
				$db->u->echop('Not a valid ID');
			}
		}
		else
		{
			$db->u->echop('No ID requested');
		}
		?>
		</div>
	</div>
</div>