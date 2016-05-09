<?php
// include_once 'includes/top-cache.php';
include_once 'includes/showerrors.inc.php';
require_once 'classes/utils.class.php';
$u = new utils;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>mframe template test page</title>
	<link rel="stylesheet" href="css-cache.php" />
<?php
header("Content-type: text/html");
?>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">				
				<a class="navbar-brand" href="#">Brand</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Articles</a></li>
			        <li><a href="#">Topics</a></li>
			        <li><a href="#">About</a></li>
			        <li><a href="#">Editors</a></li>
			        <li><a href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row" id="alert">
			<div class="alert-content col-12">
				
			</div>
		</div>
		<div class="row">
			<article class="col-6">           
				<p>The beginning of the best article in the history of humanity.</p>
			</article>
			<aside class="col-6">
				<img src="<?php $u->data_uri('img/mick.png'); ?>" id="mickpic" />
				<p>Odit officiis voluptatem magni fugiat consequatur a iste. Omnis facilis quibusdam qui saepe culpa dolore at alias. Harum perferendis temporibus consequatur et sapiente totam ut. Vel consequatur id aperiam molestias.</p>
			</aside>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>	
	<script src="js-cache.php"></script>
</body>
</html>
<?php
// include_once 'includes/bottom-cache.php';
?>