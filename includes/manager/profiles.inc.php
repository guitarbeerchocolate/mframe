<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h3>Manage profiles</h3>
			<form method="post" action="profiles/deleteprofiles" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td>
						</tr>
					</thead>
					<tbody>
					<?php					
					$rows = $db->listall('profiles','content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';							
							$u->echotr(array($inputStr,$row['name']));
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