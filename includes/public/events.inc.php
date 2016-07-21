<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Event</h2>
			<?php
			if(isset($_GET['id']))
			{
				require_once 'classes/events.class.php';
				$p = new events;
				$p->getevents($_GET['id']);
				if(isset($p->name))
				{
					$u->echoh3($p->name);
					$u->echoeol('<p><strong>From '.date("jS F Y",strtotime($p->datestart)).' to '.date("jS F Y",strtotime($p->dateend)).'</strong></p>');
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
	</div>
</div>