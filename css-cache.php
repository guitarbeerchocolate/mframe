<?php
header("Content-type: text/css");
function compressCSS($buffer)
{
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);	
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
$moduledir = 'modules';
require_once 'classes/utils.class.php';
$u = new utils;
foreach($u->getModuleFiles($moduledir) as $sheet)
{
	$sheets = trim($sheet);
	if(file_exists($sheets))
	{
		echo "/*".$sheets."*/";
		ob_start("compressCSS");
		echo file_get_contents($sheets)."\n\r";
		ob_end_flush();
	}
}
?>