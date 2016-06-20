<div class="col-md-4 authenticate">
	<div class="panel panel-default">
		<div class="panel-heading">Register</div>
		<div class="panel-body">
			<form method="POST" action="formhandler.php?action=authenticate/register" role="form" class="ajax">						
				<div class="form-group">
					<label for="username">Email:</label>
					<input type="email" name="username" id="username" class="form-control" placeholder="Email Address" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" />
				</div><!-- .form-group -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div><!-- .panel-body -->
	</div><!-- .panel -->
</div><!-- .col-md-4 -->