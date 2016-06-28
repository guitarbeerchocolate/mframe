<?php
if(isset($_GET['id']))
{
	$error = FALSE;	
	require_once 'classes/pages.class.php';
	$p = new pages;
	$p->getpage($_GET['id']);
}
else
{
	$h3 = '<h3>Error</h3>';
	$content = '<p>No ID requested</p>';
	$error = TRUE;
}
?>
<div class="row">
	<div class="container">
		<?php
		if(isset($p->name))
		{
			$h3 = $p->name;
			$content = $p->content;
		}
		else
		{
			$h3 = '<h3>Error</h3>';
			$content = '<p>Not a valid ID</p>';
			$error = TRUE;
		}
		echo '<div class="col-md-12">';
		echo '<h3>'.$h3.'</h3>';
		echo '</div>';
		?>		
	</div>
</div>

<div class="row">
	<div class="container">
		<?php
		if(($error == TRUE) || ($p->layout == 1) || ($p->layout == 0))
		{
			echo '<div class="col-md-12">';
			echo $content;
			echo '</div>';
		}
		elseif($p->layout == 2)
		{
			echo '<div class="col-md-6">';
			echo $content;
			echo '</div>';
			echo '<div class="col-md-6">';
			echo 'Something else for now';
			echo '</div>';
		}
		elseif($p->layout == 3)
		{
			echo '<div class="col-md-8">';
			echo $content;
			echo '</div>';
			echo '<div class="col-md-4">';
			echo 'Something else for now';
			echo '</div>';
		}
		?>		
	</div>
</div>