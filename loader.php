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
    $bs->tag('h3','Errors');
    foreach($ef->agg->messageArr as $err)
    {
        $bs->br($err);
    }
    $bs->hr();
}
$bs->render();
$entryCount = 0;
$feedLimit = 1;
if((isset($_GET['entrycount'])) && (is_numeric($_GET['entrycount'])) && (($_GET['entrycount'] > 0)))
{
   $feedLimit = $_GET['entrycount'];
}
foreach($arr as $row)
{
    if($feedLimit > $entryCount)
    {
        $bs->tag('h5',$bs->anchorblank($row->link, $row->title));
        $bs->hr();
        /* $bs->s .= $bs->clearfix(); */
        /* $bs->s .= $bs->tag('small',$bs->anchorblank($row->link)); */
        $bs->render();
        /*
        $db->u->echoh5('<a href="'.$row->link.'" target="_blank">'.$row->title.'</a>');
        echo $row->description;
        echo $bs->clearfix();
        $db->u->echop('<small><a href="'.strip_tags($row->link).'" target="_blank">'.strip_tags($row->link).'</a></small>');
        $db->u->echohr('Posted '.date("jS F Y",strtotime($row->pubDate)).'<br />');
        */
    }
    if((isset($_GET['entrycount'])) && (is_numeric($_GET['entrycount'])) && (($_GET['entrycount'] > 0)))
    {
       $entryCount++;
    }
}
?>