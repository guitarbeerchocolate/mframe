<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			require_once 'classes/searchpdo.class.php';
			$tableArr = array('events','news');
			$fieldArr = array('Title'=>'name','Description'=>'content');
			$spdo = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			?>
		</div>
	</div>
</div>