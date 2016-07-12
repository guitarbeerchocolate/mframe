<?php
require_once 'config.class.php';
class sessions
{
	public $sess;
	protected $c;
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
		$this->c = new config;
	}

	function logout()
	{
		session_start();
	    session_unset();
	    session_destroy();
	    session_write_close();
	    setcookie(session_name(),'',0,'/');
	    session_regenerate_id(true);
		$error = urlencode('Logged out.');
		header('location:'.$this->c->getVal('url').'&message='.$error);
		exit;
	}

	function privateRedirect()
	{
		if(!isset($this->sess['userid']))
		{
			$error = urlencode('You must be logged in to access the private section.');
			header('location:'.$this->c->getVal('formspage').'&message='.$error);
			exit;
		}
		else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
			unset($_SESSION['userid']);
			session_destroy();
			$error = urlencode('Logged out.');
			header('location:'.$this->c->getVal('formspage').'&message='.$error);
			exit;
		}
	}

	function managerRedirect()
	{
		if(!isset($this->sess['userid']))
		{
			$error = urlencode('You must be logged in to access the private section.');
			header('location:'.$this->c->getVal('formspage').'&message='.$error);
			exit;
		}
		else if(!in_array($this->sess['userid'], $this->c->getManagers()))
		{
		  $error = urlencode('You must be logged in as a manager access the manager section.');
		  header('location:'.$this->c->getVal('formspage').'&message='.$error);
		  exit;
		}
		else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
		  unset($_SESSION['userid']);
		  session_destroy();
		  $error = urlencode('Logged out.');
		  header('location:'.$this->c->getVal('formspage').'&message='.$error);
		  exit;
		}
	}
}
?>