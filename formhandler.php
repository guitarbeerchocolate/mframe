<?php
if(isset($_GET['action']))
{
	$arr = explode('/', $_GET['action']);
	$class = $arr[0];
	$method = $arr[1];	
	require_once 'classes/'.$class.'.class.php';
	
	if(class_exists($class))
	{
		$evalStr = '$'.$class.' = new '.$class.'($_POST);';		
		eval($evalStr);
		if(method_exists($class, $method))
		{
			$evalStr = '$returnValue = $'.$class.'->'.$method.'();';
			eval($evalStr);
		}
		else
		{
			$returnValue = 'Method does not exist';
			header('Location:login.php?message='.urlencode($returnValue));
		}
	}
	else
	{
		$returnValue = 'Class does not exist';
		header('Location:login.php?message='.urlencode($returnValue));
	}
}
else
{
	$returnValue = 'No action given';
	header('Location:login.php?message='.urlencode($returnValue));
}
?>