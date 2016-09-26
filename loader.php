<?php
require_once 'classes/database.class.php';
require_once 'classes/externalfeeds.class.php';
require_once 'classes/bootstrap.class.php';
$db = new database;
$ef = new externalfeeds;
$bs = new bootstrap;

if((isset($_GET['feedtype'])) && (is_numeric($_GET['feedtype'])) && (($_GET['feedtype'] > 0) && ($_GET['feedtype'] < 6)))
{
    $arr = $ef->getResults($_GET['feedtype']);
}
else
{
    $arr = $ef->getResults();    
}
if(count($ef->agg->messageArr) > 0)
{   
    $db->u->echoh3('Errors');
    foreach($ef->agg->messageArr as $err)
    {
        $db->u->echobr($err);
    }
    $db->u->echohr();
}
foreach($arr as $row)
{
	$db->u->echoh5('<a href="'.$row->link.'" target="_blank">'.$row->title.'</a>');
	echo $row->description;
	echo $bs->clearfix();
	$db->u->echop('<small><a href="'.strip_tags($row->link).'" target="_blank">'.strip_tags($row->link).'</a></small>');
	$db->u->echohr('Posted '.date("jS F Y",strtotime($row->pubDate)).'<br />');
}
?>