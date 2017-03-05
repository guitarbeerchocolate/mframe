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
	$h3 = 'Error';
	$content = '<p>No ID requested</p>';
	$error = TRUE;
}
if(isset($p->name))
{
    $h3 = $p->name;
    $content = $p->content;
}
else
{
    $h3 = 'Error';
    $content = '<p>Not a valid ID</p>';
    $error = TRUE;
}
if(isset($p->secondarycontent))
{
	if(($p->secondarycontent != NULL) || ($p->secondarycontent != ''))
	{
	    $secondarycontent = $p->secondarycontent;
	}
	else
	{
	    $secondarycontent = 'Secondary content not set';
	}
}
?>
<div class="row">
	<div class="container">
		<?php
		$sc = FALSE;
		if(isset($secondarycontent))
		{
			if((is_numeric($secondarycontent)) && ($secondarycontent != 0))
			{
				$sp = new pages;
				$sp->getpage($secondarycontent);
				$sc = TRUE;
			}
		}
		if(($error == TRUE) || ($p->layout == 1) || ($p->layout == 0))
		{
			$headName = $bs->tag('h3',$h3);
			$header = $bs->tag('header',$headName);
			$bs->tag(NULL,$header.$content,array('class'=>'col-md-12'));
			$bs->render();
		}
		elseif($p->layout == 2)
		{
			$headName = $bs->tag('h3',$h3);
			$header = $bs->tag('header',$headName);
			$bs->tag('article',$header.$content,array('class'=>'col-md-6'));
			$bs->render();
			echo '<aside class="col-md-6">';
			if($sc == TRUE)
			{
				$headName = $bs->tag('h3',$sp->name);
				$header = $bs->tag('header',$headName);
				$bs->render();
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
			$headName = $bs->tag('h3',$h3);
			$header = $bs->tag('header',$headName);
			$bs->tag('article',$header.$content,array('class'=>'col-md-8'));
			$bs->render();
			echo '<aside class="col-md-4">';
			if($sc == TRUE)
			{
				 $headName = $bs->tag('h3',$sp->name);
			                $header = $bs->tag('header',$headName);
			                $bs->render();
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