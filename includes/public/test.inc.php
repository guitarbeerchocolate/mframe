<div class="row">
	<div class="container">
		<div class="col-md-12">
			<h2>Test page</h2>
			<form action="forms/myform" method="POST">
				<input type="hidden" name="text" value="My text" />
				<button type="submit">Submit</button>
			</form>
			<?php
			require_once 'classes/pages.class.php';
			$p = new pages;
			$p->getpage('5');
			?>
			<h3><?php echo $p->name; ?></h3>
			<?php
			echo $p->content;
			?>
		</div>
	</div>
</div>