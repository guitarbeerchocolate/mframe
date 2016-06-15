<?php
class sessions
{
	public $sess;
	function __construct($sess = NULL)
	{
		if($sess == NULL)
		{
			$this->sess = $_SESSION;
		}
		else
		{
			$this->sess = $sess;	
		}
	}

	function privateRedirect($settings)
	{
		if(!isset($this->sess['userid']))
		{
			$error = urlencode('You must be logged in to access the private section.');
			header('location:'.$settings['website']['formspage'].'?message='.$error);
			exit;
		}
		else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
			unset($_SESSION['userid']);
			session_destroy();
			$error = urlencode('Logged out.');
			header('location:'.$settings['website']['formspage'].'?message='.$error);
			exit;
		}
	}

	function managerRedirect($settings, $manageridArr)
	{
		if(!isset($this->sess['userid']))
		{
			$error = urlencode('You must be logged in to access the private section.');
			header('location:'.$settings['website']['formspage'].'?message='.$error);
			exit;
		}
		else if(!in_array($this->sess['userid'], $manageridArr))
		{
		  $error = urlencode('You must be logged in as a manager access the manager section.');
		  header('location:'.$settings['website']['formspage'].'?message='.$error);
		  exit;
		}
		else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
		  unset($_SESSION['userid']);
		  session_destroy();
		  $error = urlencode('Logged out.');
		  header('location:'.$settings['website']['formspage'].'?message='.$error);
		  exit;
		}
	}
}
?>