<?php
$h2 = $bs->tag('h2','Gallery');
require_once 'classes/flickr.class.php';
$f = new flickr;
$photoset = $f->getphotoset('72157644747573064');
$imgArr = array();
foreach ($photoset as $photo)
{
	$url = 'http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_b.jpg';
	array_push($imgArr, $url);
}
$carousel = $bs->carousel($imgArr);
/*
$col = $bs->tag(NULL,$h2.$carousel,array('class'=>'col-md-12'));	
$con = $bs->tag(NULL,$col,array('class'=>'container'));
$bs->tag(NULL,$con,array('class'=>'row'));
$bs->render();
*/



$col = $bs->column($h2.$carousel);


$con = $bs->container($col);
$bs->row($con);
$bs->render();

?>

