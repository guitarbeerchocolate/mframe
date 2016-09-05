<div class="row">
	<div class="container">
		<aside class="col-md-4">
		<?php
		include_once 'includes/general/advertising.inc.php';
		?>
		</aside><!-- col-md-4 -->
		<div class="col-md-8">
			<?php
			require_once 'classes/searchpdo.class.php';
			$tableArr = array('service');
			$fieldArr = array('Service'=>'name','Description'=>'description');			
			$spdo = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			?>
		</div>
	</div>
</div>