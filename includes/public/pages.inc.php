<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			if(isset($_GET['id']))
			{
				require_once 'classes/pages.class.php';
				$p = new pages;
				$p->getpage($_GET['id']);
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
	</div>
</div>