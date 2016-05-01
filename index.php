<?php
// include_once 'includes/top-cache.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Cached skeleton template</title>
	<link rel="stylesheet" href="css-cache.php" />
<?php
header("Content-type: text/html");
require_once 'classes/utils.class.php';
$u = new utils;
?>
</head>
<body>
	<div id="holder" class="container">
		<div class="row">
			<div class="twelve columns">
				<h1>Hello world</h1>
				<img src="<?php $u->data_uri('img/mick.png'); ?>" />			
			</div>
		</div>
	</div>
	<script src="jquery/jquery-1.12.3.min.js"></script>	
	<script src="js-cache.php"></script>
</body>
</html>
<?php
// include_once 'includes/bottom-cache.php';
?>