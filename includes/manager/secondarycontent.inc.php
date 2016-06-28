<div class="form-group">
	<select class="form-control" name="secondarycontent">
	<?php
	$dontList = array('.','..','authenticate.inc.php','login.inc.php','passwordreset.inc.php','register.inc.php','resetpassword.inc.php');
	$dir = 'includes/public/sub';
	$f = scandir($dir);
	if(count($f) > 2)
	{
		foreach($f as $fname)
		{
			$path_parts = pathinfo($fname);				
			if(isset($path_parts['extension']))
			{
				if(!in_array($fname,$dontList))
				{
					echo '<option value="';
					echo 'includes/public/sub/'.$fname.'"';
					if($secondarycontent == $fname)
					{
						echo ' SELECTED';
					}
					echo '>'.$fname;
					echo '</option>';
				}
			}
		}
		$subpages = $db->performquery('SELECT * FROM pages WHERE issubpage = 1');
		foreach ($subpages as $subpage)
		{
			echo '<option value="';
			if($secondarycontent == $subpage[''])
			{
				echo ' SELECTED';
			}
			echo '>'.$fname;
			echo '</option>';
		}
	}
	else
	{
		echo 'No uploaded images';
	}
	?>
	</select>
</div>