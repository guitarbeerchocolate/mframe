<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<?php
			$rows = $db->getOneByFieldValue('pages','name','Leave it out');
			$u->var_dump_structure($rows);
			/* foreach ($rows as $row)
			{
				$u->var_dump_structure($row);
			} */
			?>
		</div>
	</div>
</div>