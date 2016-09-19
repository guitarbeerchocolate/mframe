<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h2>Manage configuration</h2>
			<?php
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('config',$id,'content');
				if(!isset($row['id']))
				{
					$error = 'The ID does not exist';
					$db->u->move_on($this->getVal('url').'manager/config',$error);
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
			<form action="<?php echo $action; ?>" method="POST" role="form">
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
			<h3>Existing configuration items</h3>
			<form method="post" action="config/deleteconfig" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Value</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('config','content');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/config&id='.$row['id'].'">Edit</a>';
							$db->u->echotr(array($inputStr,$row['name'],$row['value'],$editStr));
						}
					}
					else
					{
						$db->u->echotr(array('No existing config'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>