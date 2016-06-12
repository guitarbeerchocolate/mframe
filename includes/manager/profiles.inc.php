<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager.php?inc=profiles" class="btn btn-primary">Back</a>
			<h3>Manage profiles</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('profiles',$id);
				if(!isset($row['id']))
				{
					$error = urlencode('The ID does not exist');
					header('location:manager.php?inc=profiles&message='.$error);
					exit;
				}	
				$name = $row['name'];
				$content = $row['content'];
				$photo = $row['photo'];
				$action = 'profiles/updateprofiles';
				echo '<h4>Preview profile</h4>';
				echo '<h5>'.$name.'</h5>';
				echo $content;
				echo '<br />'.$photo;
			}
			else
			{
				$id = $db->getNextID('profiles');	
				$name = '';
				$content = '';
				$photo = '';
				$action = 'profiles/addprofiles';
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
					<label for="name">Name of profiles</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="content">Page content</label>
					<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="photo">Chosen photo</label>
					<input type="text" name="photo" class="form-control" value="<?php echo $photo; ?>" />
				</div><!-- .form-group -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div>
	</div>
</div>
<?php
include_once 'uploadedimages.inc.php';
?>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h4>Existing profiles</h4>
			<form method="post" action="formhandler.php?action=profiles/deleteprofiles" class="ajax" role="form">
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td>
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
							echo '<td>';
							echo '<a href="manager.php?inc=profiles&id='.$row['id'].'">Edit</a>';
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