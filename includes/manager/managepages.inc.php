<div class="col-md-12">
	<h3>Manage pages</h3>
</div>
<div class="col-md-12">
	<a href="manager.php?inc=addeditpage" class="btn btn-primary">Add page</a>
	<a href="manager.php" class="btn btn-primary">Back to manager</a>
	<br /><br />
	<form method="post" action="pages/deletepages" class="ajax" role="form">	
		<table class="table">
			<tbody>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			$rows = $db->listall('pages');
			foreach ($rows as $row)
			{
				echo '<tr>';
				echo '<td>';
				echo '<div class="checkbox"><label><input type="checkbox" name="id[]"';
				echo 'value="'.$row['id'].'">';
				echo ' '.$row['name'].'</label></div>';
				echo '</td>';
				echo '<td>';
				echo '<a href="manager.php?inc=addeditpage&id='.$row['id'].'">Edit</a>';
				echo '</td>';
				$u->echoeol('</tr>');
			}
			?>
			</tbody>
		</table>
		<button type="submit" class="btn btn-primary">Delete</button>
	</form>
</div>