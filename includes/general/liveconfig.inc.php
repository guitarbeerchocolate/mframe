<?php
$liveConfig = array();
if(isset($_GET['id']))
{
    $liveConfig['id'] = $_GET['id'];
}
else
{
    $liveConfig['id'] = NULL;
}
?>