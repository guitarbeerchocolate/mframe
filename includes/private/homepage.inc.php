<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			$manageridArr = explode(',',$settings['website']['managerids']);
			if(in_array($_SESSION['userid'], $manageridArr))
			{
			$u->brecho('<a href="manager.php">Go to the manager options</a>');
			}
			?>
		</div>
	</div>
</div>
