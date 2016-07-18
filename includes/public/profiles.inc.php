<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Profiles</h2>
			<?php			
			$rows = $db->listall('profiles');
			foreach ($rows as $row)
			{
				$u->echoeol('<article class="publicprofiles">');
				$u->echoeol('<h4>'.$row['name'].'</h4>');
				echo '<table class="table"><tbody><tr><td>';
				$u->base64_image($row['photo'], $row['name']);
				echo strip_tags($row['content']);
				$u->echoeol('</td></tr><tbody></table></article>');
			}
			?>	
		</div>
	</div>
</div>