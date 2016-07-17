<?php
require_once 'database.class.php';
require_once 'sessions.class.php';
require_once 'config.class.php';
class authenticate extends database
{
	private $pa, $c, $s;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->c = new config;
    }

    function login()
    {
    	if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			$username = $this->pa['username'];
			$password = sha1(md5($this->pa['password']));			
			$this->query();
			$sth = $this->prepare("SELECT id, username, password FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth, 'Records received');			
			if($error !== 'Records received')
			{
				$this->u->move_on('login.php',$error);
			}
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				if($row['password'] == $password)
				{
					session_start();
					$this->s = new sessions($_SESSION);
					$this->s->userid = $row['id'];
					$outURL = $this->c->getVal('url').'private';
					$this->u->move_on($outURL);
				}
				else
				{
					$error = 'Invalid email or password. Please try again.';
					$this->u->move_on('login.php',$error);
				}
			}
			else
			{
				$error = 'Invalid email or password. Please try again.';
				$this->u->move_on('login.php',$error);
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			$this->u->move_on('login.php',$error);
		}		
    }

    function passwordresetrequest()
    {
		if(isset($this->pa['username']))
		{
			$username = $this->pa['username'];			
			$this->query();
			$sth = $this->prepare("SELECT id, username, password FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth, 'Records received');			
			if($error !== 'Records received')
			{
				$this->u->move_on('login.php',$error);
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				if($row['username'] == $username)
				{
					$msg = $this->c->getVal('url').'?username='.urlencode($row['username']).'&password='.urlencode($row['password']);			
					mail($username,'Password reset',$msg);
					$error = 'A link has been sent to your email address. Copy the link and paste it into the address bar of your web browser to reset your password.';
					$this->u->move_on('login.php',$error);			
				}
				else
				{
					$error = 'Invalid email. Please try again.';
					$this->u->move_on('login.php',$error);
				}
			}
			else
			{
				$error = 'Invalid email. Please try again.';
				$this->u->move_on('login.php',$error);
			}
		}
		else
		{
			$error = 'Please enter an email address.';
			$this->u->move_on('login.php',$error);
		}
    }

    function register()
    {
    	if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			if(filter_var($this->pa['username'], FILTER_VALIDATE_EMAIL))
			{
				$username = $this->pa['username'];
			}
			else
			{
				$error = 'Username must be a valid email address';
				$this->u->move_on('login.php',$error);
			}

			$pwdCheck = $this->checkPassword($this->pa['password']);
			if($pwdCheck !== FALSE)
			{
				$this->u->move_on('login.php',$pwdCheck);
			}

			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth, 'Records received');			
			if($error !== 'Records received')
			{
				$this->u->move_on('login.php',$error);
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row === false) && ($sth->rowCount() == 0))
			{
				$sth = $this->prepare("INSERT INTO users (username,password) VALUES (:username,:password)");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$error = 'Registered. Please log-in';
				$this->u->move_on('login.php',$error);
			}
			else
			{
				$error = 'Username already exists.';
				$this->u->move_on('login.php',$error);
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			$this->u->move_on('login.php',$error);
		}
    }

    function resetpassword()
    {
		if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			$username = $this->pa['username'];
			$pwdCheck = $this->checkPassword($this->pa['password']);
			if($pwdCheck !== FALSE)
			{
				$this->u->move_on('login.php',$pwdCheck);
			}
			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth, 'Records received');			
			if($error !== 'Records received')
			{
				$this->u->move_on('login.php',$error);
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				$sth = $this->prepare("UPDATE users SET password = :password WHERE username = :username");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$message = 'Password reset. Please log-in';
				$this->u->move_on($this->c->getVal('formspage'),$message);
			}
			else
			{
				$error = 'Username already exists.';
				$this->u->move_on('login.php',$error);
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			$this->u->move_on('login.php',$error);
		}
    }

    function checkPassword($pwd)
    {
	    $errors = array();
	    if(strlen($pwd) < 6)
	    {
	        array_push($errors, 'Password too short. ');
	    }

	    if(!preg_match("#[0-9]+#", $pwd))
	    {
	        array_push($errors, 'Password must include at least one number. ');
	    }

	    if(!preg_match("#[a-zA-Z]+#", $pwd))
	    {
	        array_push($errors, 'Password must include at least one letter.');
	    }
	    if(empty($errors))
	    {
	    	return FALSE;
	    }
	    else
	    {
	    	return implode($errors);
	    }
	}
}
?>