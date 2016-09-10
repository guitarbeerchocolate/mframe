<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<?php
			$s = 'https://www.youtube.com/channel/UCsT0YIqwnpJCM-mx7-gSA4Q';
			$strArr = explode('/',$s);
			for($x = 0; $x < count($strArr); $x++)
			{
				if($strArr[$x] == 'channel') $cid = $strArr[++$x];
			}
			echo $cid;
			/*
			$rows = $db->listall('config');			
			$headers = array('id', 'name', 'value');
			$data = array(
				array('Row1col1','Row1col2','Row1col3'),
				array('Row2col1','Row2col2','Row2col3'),
				array('Row3col1','Row3col2','Row3col3')
			);
			$u->createTable($rows);
			*/
			?>			
		</div>
	</div>
</div>