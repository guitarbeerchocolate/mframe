<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			if(isset($_GET['searchterms']))
			{				
				/* If you use mutliple tables such as
				$spdo = array();
				$tableArr = array('message','pages');
				you are restricting the usefulness of $fieldArr.
				If you wish to search multiple tables and restrict the fields shown in each, then perform multiple searches, each time setting the value of $fieldArr.
				E.g.
				$tableArr = array('message');
				$fieldArr = array('name'=>'name','Content'=>'content');			
				$spdo[0] = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			
				$tableArr = array('pages');
				$fieldArr = array('Title'=>'title','Description'=>'description');
				$spdo[1] = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			
				$tableArr = array('profiles');
				$fieldArr = array('Name'=>'name','Details'=>'details');
				$spdo[2] = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
				*/
				require_once 'classes/searchpdo.class.php';
				$tableArr = array('pages');
				$fieldArr = array('Name'=>'name','Content'=>'content');			
				$spdo = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			
				$tableArr = array('news');
				$fieldArr = array('Name'=>'name','Content'=>'content');			
				$spdo = new searchpdo($tableArr, $fieldArr, $_GET['searchterms']);
			}
			?>
		</div>
	</div>
</div>