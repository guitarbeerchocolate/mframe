<div class="row">
  	<div class="container">
		<div class="col-md-4">		
			<div class="panel panel-default">
				<div class="panel-heading">Reset password</div>
				<div class="panel-body">
					<form method="POST" action="formhandler.php?action=authenticate/resetpassword">
						<div class="form-group">
							<label for="username">Email:</label>
							<input type="email" name="username" id="username" class="form-control" value=<?php echo $_GET['username']; ?> />
						</div><!-- .form-group -->
						<div class="form-group">
							<label for="password">New password:</label>
							<input type="password" name="password" id="password" class="form-control" />
						</div><!-- .form-group -->
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div><!-- .panel-body -->
			</div><!-- .panel -->
		</div><!-- .col-md-4 -->
	</div><!-- .container -->
</div><!-- .row -->