<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager.php" class="btn btn-primary">Back</a>
			<h3>Manage pages</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('pages',$id);
				if(!isset($row['id']))
				{
					$error = urlencode('The ID does not exist');
					header('location:manager.php?inc=pages&message='.$error);
					exit;
				}	
				$name = $row['name'];
				$content = $row['content'];
				$action = 'pages/updatepage';
				echo '<h4>Preview page</h4>';
				echo '<h5>'.$name.'</h5>';
				echo $content;
			}
			else
			{
				$id = $db->getNextID('pages');	
				$name = '';
				$content = '';
				$action = 'pages/addpage';
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
					<label for="name">Name of page</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="content">Page content</label>
					<textarea name="content" id="content" cols="30" rows="10" class="tinymce form-control"><?php echo $content; ?></textarea>
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
			<h4>Existing pages</h4>
			<form method="post" action="formhandler.php?action=pages/deletepages" class="ajax" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td>
						</tr>
					</thead>
					<tbody>
					<?php					
					$rows = $db->listall('pages');
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
							echo '<a href="manager.php?inc=pages&id='.$row['id'].'">Edit</a>';
							echo '</td>';
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing pages</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>