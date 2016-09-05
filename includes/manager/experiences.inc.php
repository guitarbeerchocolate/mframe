<div class="row">
	<div class="container">
		<div class="col-md-12">
			<br /><a href="manager" class="btn btn-primary">Back</a>
			<h2>Manage experiences</h2>
			<?php
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$row = $db->getOneByID('experiences',$id);
				if(!isset($row['id']))
				{
					$error = 'The ID does not exist';
					$db->u->move_on($db->getVal('url').'manager/events',$error);
				}
				$userid = $row['userid'];
				$user = $db->getOneByID('users',$userid);
				$serviceid = $row['serviceid'];
				$name = $row['name'];
				$description = $row['description'];	
				$overallrating = $row['overallrating'];			
				$recommend = $row['recommend'];
				$created = $row['created'];
				$suspend = $row['suspend'];
				$action = 'experiences/updateexperiences';	
			}
			else
			{	
				$id = '';
				$userid = '';
				$serviceid = '';
				$name = '';
				$description = '';
				$overallrating = '';
				$recommend = 0;
				$suspend = 0;
				$action = 'experiences/addexperiences';
			}
			?>

		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-8">
			<form action="<?php echo $action; ?>" method="POST" role="form" class="rating">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
				<input type="hidden" name="serviceid" value="<?php echo $serviceid; ?>" />				
				<div class="form-group">
					<label for="name">Name of experience</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="description">Experience description</label>
					<textarea name="description" id="description" cols="30" rows="10" class="form-control message"><?php echo $description; ?></textarea>
					<span class="countdown"></span>
				</div><!-- .form-group -->
				<div class="form-group">
					<input type="text" name="overallrating" class="form-control" value="<?php echo $overallrating; ?>" required />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="recommend" value="1" <?php if($recommend == 1) echo 'checked'; ?> /> Would you recommend this service to a friend?
					</label>
				</div><!-- .checkbox -->
				<?php
				if(!empty($user))
				{
					echo '<p>Created by <a href="mailto:'.$user['username'].'">'.$user['username'].'</a></p>';
				}
				?>
				<div class="form-group">
					<label for="suspend">Suspend?</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="suspend" value="1" <?php if($suspend == 1) echo ' checked'; ?>/>
						</label>
					</div>
				</div><!-- .form-group -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form><br />
		</div>
		<aside class="col-md-4">
		<?php
		include_once 'includes/general/advertising.inc.php';
		?>
		</aside>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h3>Existing experiences</h3>
			<form method="post" action="experiences/deleteexperiences" role="form">	
				<table class="table">
					<thead>
						<tr>
							<td></td><td>Name</td><td>Action</td><td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					$rows = $db->listall('experiences');
					if(count($rows) > 0)
					{
						foreach ($rows as $row)
						{
							$inputStr = '<input type="checkbox" name="id[]" ';
							$inputStr .= 'value="'.$row['id'].'">';
							$editStr = '<a href="manager/experiences&id='.$row['id'].'">Edit</a>';
							$previewLink = '<a href="experiences&id='.$row['id'].'" target="_blank">Preview</a>';
							$db->u->echotr(array($inputStr,$row['name'],$editStr,$previewLink));
						}
					}
					else
					{
						$db->u->echotr(array('No existing experiences'));
					}
					?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
		</div>
	</div>
</div>