<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager.php" class="btn btn-primary">Back</a>
			<h3>Manage events</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('events',$id);
				if(!isset($row['id']))
				{
					$error = urlencode('The ID does not exist');
					header('location:manager.php?inc=events&message='.$error);
					exit;
				}	
				$name = $row['name'];
				$content = $row['content'];
				$datestart = $row['datestart'];
				$dateend = $row['dateend'];
				$action = 'events/updateevents';
				echo '<h4>Preview event</h4>';
				echo '<h5>'.$name.'</h5>';
				echo $content;
				echo '<p>Start date : '.$datestart.'</p>';
				echo '<p>End date : '.$dateend.'</p>';
			}
			else
			{
				$id = $db->getNextID('events');	
				$name = '';
				$content = '';
				$datestart = '';
				$dateend = '';
				$action = 'events/addevents';
			}
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<form action="<?php echo $action; ?>" method="POST" role="form" class="ajax triggersave">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="form-group">
					<label for="name">Name of event</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="datestart">Start Date</label>
					<input type="date" name="datestart" class="form-control datepicker" value="<?php echo $datestart; ?>" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="dateend">End Date</label>
					<input type="date" name="dateend" class="form-control" value="<?php echo $dateend; ?>" />
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
			<h4>Existing events</h4>			
			<form method="post" action="events/deleteevents" class="ajax" role="form">	
				<table class="table">
					<tbody>
					<?php					
					$rows = $db->listall('events');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							echo '<tr>';
							echo '<td>';
							echo '<div class="checkbox"><label><input type="checkbox" name="id[]"';
							echo 'value="'.$row['id'].'">';
							echo ' '.$row['name'].'</label></div>';
							echo '</td>';
							echo '<td>';
							echo '<a href="manager.php?inc=events&id='.$row['id'].'">Edit</a>';
							echo '</td>';
							$u->echoeol('</tr>');
						}
					}
					else
					{
						echo '<tr><td>No existing events</td></tr>';
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>