<!DOCTYPE html>
<?php
if(isset($liveConfig['id']))
{
    echo '<html lang="en-GB" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#" itemscope itemtype="http://schema.org/Article">';
}
else
{
        echo '<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:website="http://ogp.me/ns/website" lang="en-GB" itemscope itemtype="http://schema.org/WebPage">';
}
?>
<head itemscope itemtype="http://schema.org/WebSite">
