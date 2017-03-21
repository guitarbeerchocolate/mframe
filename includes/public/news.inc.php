<div class="row">
	<div class="container">
		<div class="col-md-12" class="news">
		<h2>News item</h2>
		<?php
		if(!is_null($liveConfig['id']))
		{
			require_once 'classes/news.class.php';
			$p = new news;
			$p->getnews($liveConfig['id']);
			if(isset($p->name))
			{
				$bs->echoheader(3,$p->name);
				$bs->echop($p->content);
				$bs->render();
			}
			else
			{
				$bs->echop('Not a valid ID');
				$bs->render();
			}
		}
		else
		{
			$bs->echop('No ID requested');
			$bs->render();
		}
		?>
		</div>
	</div>
</div>