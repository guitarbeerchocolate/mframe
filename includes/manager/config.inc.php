<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h3>Manage config</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('config',$id);
				if(!isset($row['id']))
				{
					$error = urlencode('The ID does not exist');
					header('location:manager/config&message='.$error);
					exit;
				}	
				$name = $row['name'];
				$value = $row['value'];				
				$action = 'config/updateitem';	
			}
			else
			{
				$id = $db->getNextID('config');	
				$name = '';
				$value = '';
				$action = 'config/additem';
			}
			?>

		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<form action="formhandler.php?action=<?php echo $action; ?>" method="POST" role="form" class="ajax triggersave">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="form-group">
					<label for="name">Name of item</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="value">Value of item</label>
					<input type="text" name="value" class="form-control" value="<?php echo $value; ?>" required />
				</div><!-- .form-group -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h4>Existing config</h4>
			<form method="post" action="formhandler.php?action=config/deleteconfig" class="ajax" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Value</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('config');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							echo '<tr>';
							echo '<td>';
							echo '<input type="checkbox" name="id[]" ';
							echo 'value="'.$row['id'].'"></td>';
							echo '<td>'.$row['name'].'</td>';
							echo '<td>'.$row['value'].'</td>';
							echo '<td>';
							echo '<a href="manager/config&id='.$row['id'].'">Edit</a>';
							echo '</td>';							
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing config</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>