<?php
// include_once 'includes/top-cache.php';
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
	<div class="container_12">
		<nav class="grid_12">
    		<ul>
		        <li>Articles</li>
		        <li>Topics</li>
		        <li>About</li>
		        <li>Editors</li>
		        <li>Contact</li>
    		</ul>
    	</nav>
	    <div class="clear"></div>
	    <header class="grid_12">
	    	<h1>Hello world</h1>
	    </header>
	    <div class="clear"></div>
	    <article class="grid_6">
	        <p>The beginning of the best article in the history of humanity.</p>
        </article>
        <aside class="grid_6">
        	<img src="<?php $u->data_uri('img/mick.png'); ?>" />
            <p>Here is some additional information.</p>
        </aside>
	</div>
	<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>	
	<script src="js-cache.php"></script>
</body>
</html>
<?php
// include_once 'includes/bottom-cache.php';
?>