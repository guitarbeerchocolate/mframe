<?php
$class = $liveConfig['theTitle'];
$requireStr = 'classes/'.$class.'.class.php';
if(file_exists($requireStr))
{
    require_once $requireStr;
    if(class_exists($class))
    {
        $evalStr = '$'.$class.' = new '.$class.';';
        eval($evalStr);
    }
}
?>