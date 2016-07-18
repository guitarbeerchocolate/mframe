<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager.php/profiles" class="btn btn-primary">Back</a>
			<h3>Manage profiles</h3>
			<form method="post" action="formhandler.php?action=profiles/deleteprofiles" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td>
						</tr>
					</thead>
					<tbody>
					<?php					
					$rows = $db->listall('profiles');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							echo '<tr>';
							echo '<td>';
							echo '<input type="checkbox" name="id[]"';
							echo 'value="'.$row['id'].'"></td>';
							echo '<td>'.$row['name'].'</td>';
							echo '</td>';
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing profiles</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>