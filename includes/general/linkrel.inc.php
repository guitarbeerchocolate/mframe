<?php
if($liveConfig['status'] == 'public')
{
	$liveConfig['baseURL'] = $liveConfig['url'];
}
else
{
	$liveConfig['baseURL'] = $liveConfig['url'].$liveConfig['status'];
}
?>
<base href="<?php echo $liveConfig['baseURL']; ?>">
<link rel="canonical" href="<?php echo $liveConfig['currentURL']; ?>"  itemprop="url" />
<link type="text/plain" rel="author" href="<?php echo $liveConfig['url']; ?>humans.txt" />
<link rel="alternate" type="text/directory" title="vCard" href="vcard.vcf" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
if($liveConfig['status'] == 'manager')
{
	echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">';
}
?>
<link rel="stylesheet" href="css-cache.php" />
<script src="https://use.fontawesome.com/<?php echo $liveConfig['font_awesome_id']; ?>.js"></script>
<?php
$bs->echoeol();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
$bs->echoeol();
?>