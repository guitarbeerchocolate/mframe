<?php
require_once 'config.class.php';
require_once 'utilities.class.php';
class sessions
{
	public $sess, $userid;
	protected $c, $u;
	function __construct($sess = NULL)
	{
		$this->userid = NULL;
		if($sess == NULL)
		{
			$this->sess = $_SESSION;
		}
		else
		{
			$this->sess = $sess;	
		}
		if(isset($this->sess['userid']))
		{
			$this->userid = $this->sess['userid'];
		}
		$this->c = new config;
		$this->u = new utilities;
	}

	function logout()
	{
		session_start();
	    session_unset();
	    session_destroy();
	    session_write_close();
	    setcookie(session_name(),'',0,'/');
	    session_regenerate_id(true);
		$error = 'Logged out.';
		$this->u->move_on($this->c->getVal('url'),$error);
	}

	function privateRedirect()
	{
		if(!is_null($this->userid))
		{
			$error = 'You must be logged in to access the private section.';
			$this->u->move_on($this->c->getVal('formspage'),$error);
		}
		else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
			unset($_SESSION['userid']);
			session_destroy();
			$error = 'Logged out.';
			$this->u->move_on($this->c->getVal('formspage'),$error);
		}
	}

	function managerRedirect()
	{
		if(!is_null($this->userid))
		{
			$error = 'You must be logged in to access the private section.';
			$this->u->move_on($this->c->getVal('formspage'),$error);
		}
		else if(!in_array($this->userid, $this->c->getManagers()))
		{
		  $error = 'You must be logged in as a manager access the manager section.';
		  $this->u->move_on($this->c->getVal('formspage'),$error);
		}
		else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
		  unset($_SESSION['userid']);
		  session_destroy();
		  $error = 'Logged out.';
		  $this->u->move_on($this->c->getVal('formspage'),$error);
		}
	}
}
?>