<div class="row">
	<div class="container">
		<div class="col-md-6">
			<?php
			if(in_array($s->userid, $c->getManagers()))
			{
				$u->brecho('<a href="manager" class="btn btn-primary">Go to the manager options</a>');
			}
			?>
		</div>
		<aside class="col-md-3">
			<h3>Your profile</h3>
			<?php
			$row = $db->getOneByFieldValue('profiles','userid',$s->userid);
			if($row == TRUE)
			{
				$name = $row['name'];
				$content = $row['content'];
				$photo = $row['photo'];
				echo '<h4>'.$name.'</h4>';
				echo $content.'<br />';
				if(!empty($photo))
				{
					echo '<img src="'.$photo.'" class="img-responsive" />';
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
