<?php
require_once 'database.class.php';
class sessions
{
	public $sess, $userid;
	protected $u;
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
		if(isset($_SESSION['userid']))
		{
			$this->userid = $_SESSION['userid'];
		}
		$this->db = new database;
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
		$this->db->u->move_on($this->db->getVal('url'),$error);
	}

	function privateRedirect()
	{
		if(is_null($this->userid))
		{
			$error = 'You must be logged in to access the private section.';
			$this->db->u->move_on($this->db->getVal('url'),$error);
		}
		else if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
			unset($_SESSION['userid']);
			session_destroy();
			$error = 'Logged out.';
			$this->db->u->move_on($this->db->getVal('url'),$error);
		}
	}

	function managerRedirect()
	{
		if(is_null($this->userid))
		{
			$error = 'You must be logged in to access the private section.';
			$this->db->u->move_on($this->db->getVal('url'),$error);
		}
		else if(!in_array($this->userid, $this->db->getManagers()))
		{
		  $error = 'You must be logged in as a manager access the manager section.';
		  $this->db->u->move_on($this->db->getVal('url'),$error);
		}
		else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 'true')
		{
		  unset($_SESSION['userid']);
		  session_destroy();
		  $error = 'Logged out.';
		  $this->db->u->move_on($this->db->getVal('url'),$error);
		}
	}
}
?>