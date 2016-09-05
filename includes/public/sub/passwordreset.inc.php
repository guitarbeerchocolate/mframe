<div class="col-md-4 authenticate">
	<div class="panel panel-default">
		<div class="panel-heading">Password reset</div>
		<div class="panel-body">
			<form method="POST" action="formhandler.php?action=authenticate/passwordresetrequest">						
				<div class="form-group">
					<label for="username">Email:</label>
					<input type="email" name="username" id="username" class="form-control" placeholder="Email Address" />
				</div><!-- .form-group -->			
				<button type="submit" id="passwordresetsubmit" class="btn btn-primary">Submit</button>
			</form>
		</div><!-- .panel-body -->
	</div><!-- .panel -->
</div><!-- .col-md-4 -->