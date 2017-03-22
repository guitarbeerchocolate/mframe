<!DOCTYPE html>
<?php
if(isset($liveConfig['id']))
{
    echo '<html lang="en" itemscope itemtype="http://schema.org/Article">';
}
else
{
        echo '<html lang="en" itemscope itemtype="http://schema.org/Organization">';
}
?>
<head>
