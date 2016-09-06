<div class="row">
	<div class="container">		
		<div class="col-md-12">			
			<h2>Contact</h2>
			<form method="POST" action="contact/send" role="form">
				<div class="form-group">
					<label for="emailaddress">Email address</label>
					<input type="email" class="form-control" id="emailaddress" name="emailaddress" placeholder="Enter email" required />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="details">Details</label>
					<textarea class="form-control" id="details" name="details" rows="3" required></textarea>
				</div><!-- .form-group -->				                      
				<button type="submit" class="btn btn-primary" id="contactsubmit">Send</button>
			</form>
		</div><!-- .col-md-12 -->
	</div><!-- .container -->
</div><!-- .row -->