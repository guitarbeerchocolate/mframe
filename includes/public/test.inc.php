<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<?php
			$rows = $db->listorderbywhere('pages','layout','1','layout');
			$u->var_dump_structure($rows);
			/* foreach ($rows as $row)
			{
				$u->var_dump_structure($row);
			} */
			?>
		</div>
	</div>
</div>