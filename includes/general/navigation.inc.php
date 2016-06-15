<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">MENU</button>
			<a href="index.php" class="navbar-brand" itemscope itemtype="http://schema.org/Organization"><img src="img/smalllogo.png" alt="logo" itemprop="logo" id="logo" /><h1 itemprop="name" align="right">mframe</h1></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<?php
				include_once 'includes/public/sessionhandler.inc.php';
				?>
			</ul>      
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>