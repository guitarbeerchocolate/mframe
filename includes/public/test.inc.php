<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<table>
				<tbody>
				<?php
				$rows = $db->listallLimit('externalfeeds', 2);
				foreach ($rows as $row)
				{
					$u->echobr($row['name']);
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>