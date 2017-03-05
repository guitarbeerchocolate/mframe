<div class="col-md-4 authenticate">
	<div class="panel panel-default">
		<div class="panel-heading">Login</div>
		<div class="panel-body">
			<?php
			$usernameInput = $bs->input('username', 'Email:', 'email');
			$passwordInput = $bs->input('password', 'Password:', 'password');
			$fields = array($usernameInput,$passwordInput);
			$action = $db->getVal('https_url').'formhandler.php?action=authenticate/login';
			$bs->form($fields,$action,FALSE,NULL);
			$bs->render();
			?>
		</div><!-- .panel-body -->
	</div><!-- .panel -->
</div><!-- .col-md-4 -->