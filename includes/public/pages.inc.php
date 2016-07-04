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
		if(($p->secondarycontent != NULL) || ($p->secondarycontent != ''))
		{
			$secondarycontent = $p->secondarycontent;
		}
		else
		{
			$secondarycontent = 'Secondary content not set';
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
		$sc = FALSE;
		if((is_numeric($secondarycontent)) && ($secondarycontent != 0))
		{
			$sp = new pages;
			$sp->getpage($secondarycontent);
			$sc = TRUE;
		}		
		if(($error == TRUE) || ($p->layout == 1) || ($p->layout == 0))
		{
			echo '<div class="col-md-12">';
			echo $content;
			echo '</div>';
		}
		elseif($p->layout == 2)
		{
			echo '<article class="col-md-6">';
			echo $content;
			echo '</article>';
			echo '<aside class="col-md-6">';
			if($sc == TRUE)
			{
				echo '<header><h3>'.$sp->name.'</h3></header>';
				echo $sp->content;
			}
			else
			{
				include_once $secondarycontent;
			}
			echo '</aside>';
		}
		elseif($p->layout == 3)
		{
			echo '<article class="col-md-8">';
			echo $content;
			echo '</article>';
			echo '<aside class="col-md-4">';
			if($sc == TRUE)
			{
				echo '<header><h3>'.$sp->name.'</h3></header>';
				echo $sp->content;
			}
			else
			{
				include_once $secondarycontent;
			}
			echo '</aside>';
		}
		?>		
	</div>
</div>