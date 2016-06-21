<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			require_once 'classes/externalfeeds.class.php';
			$ef = new externalfeeds;
			$arr = $ef->getResults();
			foreach($arr as $row)
			{
				echo '<h5><a href="'.$row->link.'" target="_blank">'.$row->title.'</a></h5>';
				echo '<p>'.strip_tags($row->description).'</p>';				
				echo 'Posted ';				
				echo date("jS F Y",strtotime($row->pubDate)).'<br /><hr />';	
			}
			?>
		</div>
	</div>
</div>