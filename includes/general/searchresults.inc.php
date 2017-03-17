<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			require_once 'classes/searchpdo.class.php';
			$tableArr = array('events','news');
			$fieldArr = array('Title'=>'name','Description'=>'content');
			$sclass = new searchpdo;
			if($liveConfig['status'] == 'manager')
			{
				$tableArr = array('config','events','externalfeeds','navigation','news','pages','profiles','blog');
				$fieldArr = array('Name'=>'name');
				$sclass = new searchpdo;
				$spdo = $sclass->managerSearch($tableArr, $fieldArr, $_GET['searchterms']);
			}
			else
			{
				$tableArr = array('events','news','blog','pages');
				$fieldArr = array('Title'=>'name','Description'=>'content');
				$sclass = new searchpdo;
				$spdo = $sclass->publicSearch($tableArr, $fieldArr, $_GET['searchterms']);
			}
			?>
		</div>
	</div>
</div>