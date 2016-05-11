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
	<?php
	include_once 'includes/meta.inc.php';
	?>	
	<title>mframe template start page</title>
	<?php
	include_once 'includes/icons.inc.php';
	?>
	<link rel="stylesheet" href="css-cache.php" />
<?php
header("Content-type: text/html");
?>
</head>
<body>
	<?php
	include_once 'includes/googletracker.inc.php';
	include_once 'includes/navigation.inc.php';
	include_once 'includes/alert.inc.php';
	include_once 'includes/header.inc.php';
	?>	
	<div class="row">
		<div class="container">
			<div class="col-md-12">Content goes here.</div>
		</div>
	</div>
	<?php
	include_once 'includes/footer.inc.php';
	?>
	<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>	
	<script src="js-cache.php"></script>
</body>
</html>
<?php
// include_once 'includes/bottom-cache.php';
?>