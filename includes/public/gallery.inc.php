<div class="col-md-12">
	<h2>Gallery</h2>
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">	
		<div class="carousel-inner">
		<?php
		require_once 'classes/flickr.class.php';
		$f = new flickr;
		$count = 0;
		/* $photoset = $f->getphotoset('72157626689676462'); */
		$photoset = $f->getphotoset('72157644747573064');

		foreach ($photoset as $photo)
		{
			echo '<div class="item';
			if($count == 0)
			{
				echo ' active';
				$count++;
			}
			echo '">';
			$url = 'http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_b.jpg';
			echo '<img src="'.$url.'" alt="gallery" />';
			$u->echoeol('</div>');
		}
		?>
		</div><!-- .carousel-inner -->
		<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div><!-- carousel -->
</div>