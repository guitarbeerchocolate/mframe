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
        $headeranchor = $bs->tag('a', $row->title, array('href'=>$row->link, 'target'=>'_blank'));
        $h5 = $bs->tag('h5',$headeranchor);
        $articleHeader = $bs->tag('header',$h5);
        $clearfix = $bs->tag(NULL,NULL,array('class'=>'clearfix'));
        $linkanchor = $bs->tag('a',$row->link, array('href'=>$row->link, 'target'=>'_blank'));
        $linkanchor = $bs->tag('small',$linkanchor);
        $linkanchor = $bs->tag('p',$linkanchor);
        $articleFooter = $bs->tag('footer','Posted '.date("jS F Y",strtotime($row->pubDate)));
        $hr = $bs->tag('hr');
        $bs->tag('article',$articleHeader.$row->description.$clearfix.$linkanchor.$articleFooter.$hr);
        $bs->render();
    }
    if((isset($_GET['entrycount'])) && (is_numeric($_GET['entrycount'])) && (($_GET['entrycount'] > 0)))
    {
       $entryCount++;
    }
}
?>