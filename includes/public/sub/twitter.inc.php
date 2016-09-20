<h3>Twitter feed</h3>
<?php
require_once 'classes/database.class.php';
$db = new database;
require_once 'classes/externalfeeds.class.php';
$ef = new externalfeeds;
$arr = $ef->getResults();
if(count($arr) !== 0)
{
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
		$db->u->echop($row->description);
		$db->u->echop('<small><a href="'.strip_tags($row->link).'" target="_blank">'.strip_tags($row->link).'</a></small>');
		$db->u->echohr('Posted '.date("jS F Y",strtotime($row->pubDate)).'<br />');	
	}
}
else
{
	$db->u->echop('No existing tweets');
}
?>
<p id="socialmedia">Follow us on <a href="https://twitter.com/guitarbeerchoco" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></p>