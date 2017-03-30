<!DOCTYPE html>
<?php
if(isset($liveConfig['id']))
{
    echo '<html lang="en" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#" itemscope itemtype="http://schema.org/Article">';
}
else
{
        echo '<html lang="en" itemscope itemtype="http://schema.org/Organization">';
}
?>
<head>
