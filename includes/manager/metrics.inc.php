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
				echo '<tr><td>Number of registered users</td><td>'.$ru.'</td></tr>';
				echo '<tr><td>Number of services</td><td>'.$rs.'</td></tr>';
				echo '<td>Number of experiences</td><td>'.$re.'</td></tr>';
				/*
				echo '<td>Number of visits</td>'..'</td>';
				*/
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>