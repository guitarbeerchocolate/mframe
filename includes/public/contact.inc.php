<div class="row">
	<div class="container">
		<aside class="col-md-4">
		<?php
		include_once 'includes/general/advertising.inc.php';
		?>
		</aside>
		<div class="col-md-8">			
			<h2>Contact</h2>
			<form method="POST" action="contact/send" role="form">
				<input type="hidden" name="remoteip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
				<div class="form-group">
					<label for="emailaddress">Email address</label>
					<input type="email" class="form-control" id="emailaddress" name="emailaddress" placeholder="Enter email" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="details">Details</label>
					<textarea class="form-control" id="details" name="details" rows="3" required></textarea>
				</div><!-- .form-group -->
				<div class="g-recaptcha" data-sitekey="6LcWNyYTAAAAAPF2wSqCJykxBTuF_5VeuNyQldlT"></div><br />                      
				<button type="submit" class="btn btn-primary" id="contactsubmit">Send</button>
			</form>
		</div><!-- .col-md-3 -->
		
	</div><!-- .container -->
</div><!-- .row -->