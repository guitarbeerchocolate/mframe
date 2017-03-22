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
    if((isset($metaData)) && (!empty($metaData)))
    {
        $liveConfig['theDescription'] = trim(substr(strip_tags($metaData['content']),0,200));
    ?>
    <meta name="description" content="<?php echo $liveConfig['theDescription']; ?>" />
    <meta name="keywords" content="<?php echo $db->getVal('meta_keywords'); ?>" />
    <meta name="author" content="Mick Redman, mick.redman@effectivewebdesigns.co.uk">

    <meta itemprop="name" content="<?php echo $metaData['name']; ?>">
    <meta itemprop="description" content="<?php echo $liveConfig['theDescription']; ?>">
    <meta itemprop="image" content="<?php echo $db->getVal('url'); ?>icon.png">

    <meta name="dc.language" content="en">
    <meta name="dc.title" content="<?php echo $metaData['name'].' : '.$db->getVal('name'); ?>">
    <meta name="dc.description" content="<?php echo $liveConfig['theDescription']; ?>">
    <?php
    if($db->getVal('twitter_handle') !== '')
    {
    ?>
    <meta name="twitter:card" content="article">
    <meta name="twitter:site" content="@<?php echo $db->getVal('twitter_handle'); ?>">
    <meta name="twitter:title" content="<?php echo $metaData['name']; ?>">
    <meta name="twitter:description" content="<?php echo $liveConfig['theDescription']; ?>">
    <meta name="twitter:creator" content="@<?php echo $db->getVal('twitter_handle'); ?>">
    <meta name="twitter:image" content="<?php echo $db->getVal('url'); ?>icon.png">
    <?php
    }
    ?>
    <meta property="og:title" content="<?php echo $liveConfig['theTitle'].' : '.$db->getVal('name'); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo $liveConfig['currentURL']; ?>" />
    <meta property="og:image" content="<?php echo $db->getVal('url'); ?>icon.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="250" />
    <meta property="og:image:height" content="250" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:description" content="<?php echo $liveConfig['theDescription']; ?>" />
    <meta name="ROBOTS" content="INDEX, FOLLOW">
    <?php
    }
    else
    {
    ?>
    <meta name="description" content="<?php echo $liveConfig['theDescription']; ?>" />
    <meta name="keywords" content="<?php echo $db->getVal('meta_keywords'); ?>" />
    <meta name="author" content="Mick Redman, mick.redman@effectivewebdesigns.co.uk">

    <meta itemprop="name" content="<?php echo $metaData['name']; ?>">
    <meta itemprop="description" content="<?php echo $liveConfig['theDescription']; ?>">
    <meta itemprop="image" content="<?php echo $db->getVal('url'); ?>icon.png">

    <meta name="dc.language" content="en">
    <meta name="dc.title" content="<?php echo $liveConfig['theTitle'].' : '.$db->getVal('name'); ?>">
    <meta name="dc.description" content="<?php echo $liveConfig['theDescription']; ?>">
    <?php
    if($db->getVal('twitter_handle') !== '')
    {
    ?>
    <meta name="twitter:card" content="organization">
    <meta name="twitter:site" content="@<?php echo $db->getVal('twitter_handle'); ?>">
    <meta name="twitter:title" content="<?php echo $liveConfig['theTitle']; ?>">
    <meta name="twitter:description" content="<?php echo $liveConfig['theDescription']; ?>">
    <meta name="twitter:creator" content="@<?php echo $db->getVal('twitter_handle'); ?>">
    <meta name="twitter:image" content="<?php echo $db->getVal('url'); ?>icon.png">
    <?php
    }
    ?>
    <meta property="og:title" content="<?php echo $liveConfig['theTitle'].' : '.$db->getVal('name'); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo $liveConfig['currentURL']; ?>" />
    <meta property="og:image" content="<?php echo $db->getVal('url'); ?>icon.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="250" />
    <meta property="og:image:height" content="250" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:description" content="<?php echo $liveConfig['theDescription']; ?>" />
    <meta name="ROBOTS" content="INDEX, FOLLOW">
    <?php
    }
}
else
{
  echo '<meta name="googlebot" content="noindex">'.PHP_EOL;
  echo '<meta name="robots" content="noindex">'.PHP_EOL;
}
?>