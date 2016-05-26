<div class="row">
	<div class="container">
		<div class="col-md-12">
		<h4>Uploaded images</h4>
		<?php
		$dir = 'img/data';
		$f = scandir($dir);
		echo '<table class="table">';
		echo '<thead>';
		echo '<tr>';
		echo '<td>Image</td><td>Path</td>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($f as $fname)
		{
			$path_parts = pathinfo($fname);				
			if(isset($path_parts['extension']))
			{
				if(($fname != '.') && ($fname != '..'))
				{
					echo '<tr>';
					echo '<td><img src="img/data/'.urlencode($fname).'" class="thumbnail" /></td>';
					echo '<td>img/data/'.urlencode($fname).'</td>';
					echo '</tr>';
				}
			}
		}
		echo '</tbody>';
		echo '</table>';
		?>
		</div>
	</div>
</div>