<?php
require_once 'classes/config.class.php';
$conf =  new config;
foreach ($conf->i as $ci)
{
    $liveConfig[$ci['name']] = $ci['value'];
}
if(isset($_GET['id']))
{
    $liveConfig['id'] = $_GET['id'];
}
else
{
    $liveConfig['id'] = NULL;
}
?>