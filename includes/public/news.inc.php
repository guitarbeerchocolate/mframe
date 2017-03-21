<div class="row">
	<div class="container">
		<div class="col-md-12" class="news">
		<h2>News item</h2>
		<?php
		if(!is_null($liveConfig['id']))
		{
			$n = $news->getdata($liveConfig['id']);
			if(isset($n['name']))
			{
				$bs->echoheader(3,$n['name']);
				$bs->echop($n['content']);
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