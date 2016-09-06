<div class="row">
	<div class="container">		
		<aside class="col-md-12">
			<h3>Your profile</h3>
			<?php
			$row = $db->getOneByFieldValue('profiles','userid',$s->userid);
			if($row == TRUE)
			{
				$name = $row['name'];
				$content = $row['content'];
				$photo = $row['photo'];
				$db->u->echoh4($name);
				$db->u->echobr($content);
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
