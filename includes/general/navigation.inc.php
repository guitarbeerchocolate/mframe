<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header" itemscope itemtype="http://schema.org/Organization">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">MENU</button>
			<a href="index.php" class="navbar-brand" itemprop="url"><img src="img/smalllogo.png" alt="logo" itemprop="logo" id="logo" /><h1 itemprop="name"><?php echo $db->getVal('name'); ?></h1></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form action="<?php echo $db->getVal('url'); ?>index.php" method="GET" class="navbar-form navbar-right" role="search" id="searchbox">
				<div class="input-group">
					<input type="text" class="form-control" name="searchterms" placeholder="Search for...">
				</div><!-- /input-group -->
				<button class="btn btn-primary" type="submit">Search</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<?php
				include_once 'includes/public/sessionhandler.inc.php';
				?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<?php
			if($liveConfig['status'] == 'manager')
			{
				$action = 'manager';
			}
			else
			{
				$action = 'index.php';
			}
			?>
		</div>
	</div>
</div>