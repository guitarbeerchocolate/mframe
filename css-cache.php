<?php
header("Content-type: text/css");
function compressCSS($buffer)
{
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);	
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
$get_styles = array('skeleton/css/normalize.css','skeleton/css/skeleton.css','css/custom.css');
foreach($get_styles as $sheet)
{
	$sheets = trim($sheet);
	if(file_exists($sheets))
	{
		echo "/*".$sheets."*/";
		ob_start("compressCSS");
		echo file_get_contents($sheets) . "\n\r";
		ob_end_flush();
	}
}
?>