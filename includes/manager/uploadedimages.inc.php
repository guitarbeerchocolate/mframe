<?php
$h4 = $bs->tag('h4','Uploaded images');
$rowArr = array();
$dir = 'img/data';
$f = scandir($dir);
if(count($f) > 2)
{
	foreach($f as $fname)
	{
		$path_parts = pathinfo($fname);
		if(isset($path_parts['extension']))
		{
			if(($fname != '.') && ($fname != '..'))
			{
				echo '<tr>';
				$img = '<img src="img/data/'.urlencode($fname).'" class="thumbnail" />';
				$imgPath = 'img/data/'.urlencode($fname);
				array_push($rowArr, array($img,$imgPath));
			}
		}
	}
	$table = $bs->table(array('Image','Path'),$rowArr);
}
else
{
	$table = 'No uploaded images';
}
$bs->singleRow(NULL, $h4.$table);
$bs->render();
?>