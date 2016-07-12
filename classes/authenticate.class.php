<?php
require_once 'database.class.php';
require_once 'config.class.php';
class authenticate extends database
{
	private $pa, $c;
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
			$sth->execute();	
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				if($row['password'] == $password)
				{
					session_start();
					$_SESSION['userid'] = $row['id'];
					$outURL = $this->c->getVal('url').'private';
					header('Location:'.$outURL);
				}
				else
				{
					$error = 'Invalid email or password. Please try again.';
					header('Location:login.php?message='.urlencode($error));
					exit;
				}
			}
			else
			{
				$error = 'Invalid email or password. Please try again.';
				header('Location:login.php?message='.urlencode($error));
				exit;
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			header('Location:login.php?message='.urlencode($error));
			exit;
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
			$sth->execute();	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				if($row['username'] == $username)
				{
					$msg = $this->c->getVal('url').'?username='.urlencode($row['username']).'&password='.urlencode($row['password']);			
					mail($username,'Password reset',$msg);
					$error = 'A link has been sent to your email address. Copy the link and paste it into the address bar of your web browser to reset your password.';
					header('Location:login.php?message='.urlencode($error));
					exit;			
				}
				else
				{
					$error = 'Invalid email. Please try again.';
					header('Location:login.php?message='.urlencode($error));
					exit;
				}
			}
			else
			{
				$error = 'Invalid email. Please try again.';
				header('Location:login.php?message='.urlencode($error));
				exit;
			}
		}
		else
		{
			$error = 'Please enter an email address.';
			header('Location:login.php?message='.urlencode($error));
			exit;
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
				header('Location:login.php?message='.urlencode($error));
				exit;
			}

			$pwdCheck = $this->checkPassword($this->pa['password']);
			if($pwdCheck !== FALSE)
			{
				header('Location:login.php?message='.urlencode($pwdCheck));
				exit;
			}

			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$sth->execute();	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row === false) && ($sth->rowCount() == 0))
			{
				$sth = $this->prepare("INSERT INTO users (username,password) VALUES (:username,:password)");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$error = 'Registered. Please log-in';
				header('Location:login.php?message='.urlencode($error));
			}
			else
			{
				$error = 'Username already exists.';
				header('Location:login.php?message='.urlencode($error));
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			header('Location:login.php?message='.urlencode($error));
			exit;
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
				header('Location:login.php?message='.urlencode($pwdCheck));
				exit;
			}
			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$sth->execute();	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				$sth = $this->prepare("UPDATE users SET password = :password WHERE username = :username");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$message = 'Password reset. Please log-in';
				$outURL = $this->c->getVal('formspage').'&message='.$message;
				header('Location:'.$outURL);
				exit;
			}
			else
			{
				$error = 'Username already exists.';
				header('Location:login.php?message='.urlencode($error));
				exit;
			}
		}
		else
		{
			$error = 'Please enter an email and password to login.';
			header('Location:login.php?message='.urlencode($error));
			exit;
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