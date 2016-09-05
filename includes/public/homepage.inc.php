<div class="row">
	<div class="container">
		<aside class="col-md-4">
		<?php
		include_once 'includes/general/advertising.inc.php';
		?>
		</aside><!-- col-md-4 -->
		<?php
		$rows = $db->listorderby('service','created','DESC');		
		for ($i=0; $i < 2; $i++)
		{ 
			echo '<article class="col-md-4 recentlyAdded">';
			if(!empty($rows[$i]['photo']))
			{

				echo '<img src="" alt="'.$rows[$i]['name'].'" class="img-responsive base64" data-id="'.$rows[$i]['id'].'" itemprop="image" />';
				echo '<i class="fa fa-spinner fa-spin fa-4x fa-fw"></i>';
			}
			else
			{
				$db->u->base64_image('img/blank.png', 'Blank');
			}
			$db->u->echoh4($rows[$i]['name']);
			$small = substr($rows[$i]['description'], 0, 100);
			echo $small;
			if(strlen($small) < strlen($rows[$i]['description'])) echo '...';
			echo '<a href="service&id='.$rows[$i]['id'].'">more</a>';
			echo '</article>';
		}
		?>
	</div><!-- .container -->
</div><!-- .row -->
<div class="row">
	<div class="container"><hr />
	<?php
	include_once 'includes/public/sub/news.inc.php';
	include_once 'includes/public/sub/twitter.inc.php';
	?>
	</div><!-- .container -->
</div><!-- .row -->