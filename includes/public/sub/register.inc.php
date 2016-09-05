<div class="col-md-4 authenticate">
	<div class="panel panel-default">
		<div class="panel-heading">Register</div>
		<div class="panel-body">
			<form method="POST" action="formhandler.php?action=authenticate/register">
				<input type="hidden" name="remoteip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
				<div class="form-group">
					<label for="username">Email:</label>
					<input type="email" name="username" id="username" class="form-control" placeholder="Email Address" />
				</div><!-- .form-group -->
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" />
				</div><!-- .form-group -->
				<div class="checkbox">
					<label>						
						<input type="checkbox" name="termsaccepted" > Accept the <a data-toggle="modal" data-target=".modal">Terms of use?</a>
					</label>
				</div>
				<div class="g-recaptcha" data-sitekey="6LcWNyYTAAAAAPF2wSqCJykxBTuF_5VeuNyQldlT"></div><br />
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div><!-- .panel-body -->
	</div><!-- .panel -->
</div><!-- .col-md-4 -->
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Website terms of use</h4>
      </div>
      <div class="modal-body">
        <?php
        include_once 'includes/public/sub/termsofusecontent.inc.php';
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->