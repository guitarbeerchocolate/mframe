<div class="row">
  	<div class="container">
		<div id="message" class="col-md-12">
			<div class="alert alert-warning">
			<?php
			if(isset($_GET['message']))
			{
				echo urldecode($_GET['message']);
				echo "<script>document.getElementById('message').style.display = 'block';</script>";
			}
			?>
			</div><!-- .alert -->
		</div><!-- #message -->
	</div><!-- .container -->
</div><!-- .row -->