<?php
header("Content-type: text/javascript");
function compressJS($buffer)
{
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
$moduledir = 'modules';
require_once 'classes/utilities.class.php';
$u = new utilities;
ob_start("compressJS");
foreach($u->getModuleFiles($moduledir,'js') as $js)
{
	$jss = trim($js);
	if(file_exists($jss))
	{
		echo "/*".$jss."*/";
		echo file_get_contents($jss);
	}
}
ob_end_flush();
?>