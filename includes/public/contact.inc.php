<div class="row">
	<div class="container">
		<div class="col-md-3">
			<h3>Our Mailing List</h3>
			<p>Change the value of input 'list' to your mailing list.</p>
			<p>Change the value of input 'redirect-success' to your own confirmation URL.</p>
			<p>Set up the confirmation message.</p>
			<form action='http://hosting.heartinternet.uk/list.cgi' method='post' role="form">
				<input type='hidden' name='list' value='testlist'/>
				<input type='hidden' name='redirect-success' value='http://www.effectivewebdesigns.co.uk/complete.html'/>
				<div class="form-group">
					<label for="email">Email address</label>
					<input type='email' name='email' class="form-control" required />
				</div>
				<div class="radio">
					<label>
						<input class='radio' type='radio' name='action' value='add' checked='checked'/>Subscribe
					</label>
				</div><!-- .radio -->
				<div class="radio">
					<label>
						<input class='radio' type='radio' name='action' value='delete'/>Unsubscribe
					</label>
				</div><!-- .radio -->
				<input type='submit' value='Submit' class="btn btn-primary" />
			</form>
		</div><!-- .col-md-3 -->
		<div class="col-md-3">
			<h3>Send a message</h3>
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
		</div><!-- .col-md-3 -->
		<div class="col-md-3">
			<h3>Contact details</h3>
			<h4>Address</h4>
			<p>4 St. Georges' Close, Toddington, Bedfordshire, LU5 6AT, UK</p>
			<h4>Telephone</h4>
			<p>+44 (0)1525 877 824</p>
			<h4>email</h4>
			<p>
				<a href="mailto:mick.redman@effectivewebdesigns.co.uk">mick.redman@effectivewebdesigns.co.uk</a>
			</p>	
		</div><!-- .col-md-3 -->
		<div class="col-md-3">
			<script src="http://maps.googleapis.com/maps/api/js"></script>
			<script>
			function initialize()
			{
				var myLatlng = new google.maps.LatLng(51.950052,-0.533823);
		  		var mapOptions =
		  		{
		    		zoom: 12,
		    		center: myLatlng
		  		}
		  		var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
		  		var marker = new google.maps.Marker(
		  		{
		      		position: myLatlng,
		      		map: map,
		      		title: 'Effective Web Designs Ltd.'
		  		});
			}
			google.maps.event.addDomListener(window, 'load', initialize);
			</script>
			<div id="googleMap" style="width:18em;height:18em;"></div>
		</div><!-- .col-md-3 -->
	</div>
</div>