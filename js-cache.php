<?php
header("Content-type: text/javascript");
function compressJS($buffer)
{
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
$get_js = array('js/custom.js');
ob_start("compressJS");
foreach($get_js as $js)
{
	$jss = trim($js);
	if(file_exists($jss))
	{
		echo "/*" . $jss . "*/";
		echo file_get_contents($jss);
	}
}
ob_end_flush();
?>