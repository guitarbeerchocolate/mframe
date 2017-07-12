<?php
$liveConfig['facebook_page'] = $db->getVal('facebook_page');
$liveConfig['twitter_page'] = $db->getVal('twitter_page');
if((isset($liveConfig['facebook_page'])) || (isset($liveConfig['twitter_page'])))
{
?>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "<?php echo $liveConfig['titleString']; ?>",
    "url": "<?php echo $liveConfig['baseURL']; ?>",
    "sameAs": [
    <?php
    if(isset($liveConfig['facebook_page']))
    {
      echo '"'.$liveConfig['facebook_page'].'"';
      if(isset($liveConfig['twitter_page'])) echo ','.PHP_EOL."\t";
    }
    if(isset($liveConfig['twitter_page'])) echo '"'.$liveConfig['twitter_page'].'"'.PHP_EOL;
    ?>
    ]
  }
</script>
<?php
}
?>