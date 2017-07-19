<?php
$bs->echoeol();
if($liveConfig['status'] == 'public')
{
?>
<meta name="msvalidate.01" content="" />
<meta name="google-site-verification" content="" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php
    $liveConfig['meta_description'] = trim(substr(strip_tags($liveConfig['meta_description']),0,200));
    if($liveConfig['theTitle'] == NULL)
    {
        $liveConfig['titleString'] = $liveConfig['name'];
    }
    else
    {
        $liveConfig['titleString'] = $liveConfig['theTitle'].' : '.$liveConfig['name'];
    }
    include 'includes/general/basic-meta.inc.php';
    include 'includes/general/itemprop-meta.inc.php';
    include 'includes/general/dc-meta.inc.php';
    if($liveConfig['twitter_handle'] !== '')
    {
        include 'includes/general/twitter-meta.inc.php';
    }
    include 'includes/general/og-meta.inc.php';
    include 'includes/general/robots-meta.inc.php';
    echo $bs->title($liveConfig['titleString']);
}
else
{
  echo '<meta name="googlebot" content="noindex">'.PHP_EOL;
  echo '<meta name="robots" content="noindex">'.PHP_EOL;
  echo $bs->title($liveConfig['titleString']);
}

?>