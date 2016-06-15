<div class="row">
	<div class="container">
		<div class="col-md-6">
			<?php
			$manageridArr = explode(',',$settings['website']['managerids']);
			$sess_id = $_SESSION['userid'];
			if(in_array($sess_id, $manageridArr))
			{
				$u->brecho('<a href="manager.php" class="btn btn-primary">Go to the manager options</a>');
			}
			?>
		</div>
		<aside class="col-md-3">
			<h3>Your profile</h3>
			<?php
			require_once 'classes/database.class.php';
			$db = new database;
			$row = $db->getOneByFieldValue('profiles','userid',$sess_id);			
			if($row == TRUE)
			{
				$name = $row['name'];
				$content = $row['content'];
				$photo = $row['photo'];
				echo '<h4>'.$name.'</h4>';
				echo $content.'<br />';
				if(!empty($photo))
				{
					echo '<img src="'.$photo.'" />';
				}
				$action = 'profiles/updateprofiles';
				include 'sub/profileform.inc.php';
			}
			else
			{
				$name = '';
				$content = '';
				$photo = '';
				$action = 'profiles/addprofiles';
				include 'sub/profileform.inc.php';
			}
			?>
		</aside>
	</div>
</div>
