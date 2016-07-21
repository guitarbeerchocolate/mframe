<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Metrics</h2>
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<table class="table">
				<tbody>
				<?php
				$ru = $db->countrow('users');
				$rs = $db->countrow('service');
				$re = $db->countrow('experiences');
				$u->echotr(array('Number of registered users',$ru));
				$u->echotr(array('Number of services',$rs));
				$u->echotr(array('Number of experiences',$re));
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>