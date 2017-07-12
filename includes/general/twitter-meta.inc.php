<meta name="twitter:card" content="article">
<meta name="twitter:site" content="@<?php echo $db->getVal('twitter_handle'); ?>">
<meta name="twitter:title" content="<?php echo $metaData['name']; ?>">
<meta name="twitter:description" content="<?php echo $liveConfig['theDescription']; ?>">
<meta name="twitter:creator" content="@<?php echo $db->getVal('twitter_handle'); ?>">
<meta name="twitter:image" content="<?php echo $db->getVal('url'); ?>icon.png">
<meta name="twitter:image:alt" content="<?php echo $metaData['name']; ?>" />
<?php
echo PHP_EOL;
?>