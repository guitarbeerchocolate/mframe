<div class="col-md-12">
	<h2>Profiles</h2>
	<?php
	require_once 'classes/database.class.php';
	$db = new database;
	$rows = $db->listall('profiles');
	foreach ($rows as $row)
	{
		$u->echoeol('<article class="publicprofiles">');
		$u->echoeol('<h4>'.$row['name'].'</h4>');
		echo '<table class="table"><tbody><tr><td>';
		$u->echoeol('<img src="'.$row['photo'].'" alt="'.$row['name'].'" /></td><td>');
		echo strip_tags($row['content']);
		$u->echoeol('</td></tr><tbody></table></article>');
	}
	?>	
</div>