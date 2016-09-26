<?php
require_once 'database.class.php';
require_once 'sessions.class.php';
class authenticate extends database
{
	private $pa, $s;
    public function __construct($postArray = array())
    {
        parent::__construct();             
        $this->pa = $postArray;        
    }

    function login()
    {
    	if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			
			$username = $this->pa['username'];
			$password = sha1(md5($this->pa['password']));
			$this->query();
			$sth = $this->prepare("SELECT id, username, password FROM users USE INDEX (content) WHERE username = :username");	
			$sth->bindParam(':username', $username);
			$error = $this->testExecute($sth);
			if($error !== TRUE)
			{
				$outURL = $this->getVal('url').'login&message='.urlencode($error);
				header('Location:'.$outURL);
				exit;
			}
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				
				if($row['password'] == $password)
				{
					$outURL = $this->getVal('url').'private&setuid='.$row['id'].'&secret='.$row['password'];
					header('Location:'.$outURL);
					exit;
				}
				else
				{
					$this->invalidEmail();
				}
			}
			else
			{
				$this->invalidEmail();
			}
		}
		else
		{
			$this->pleaseEnter();
		}
    }

    function passwordresetrequest()
    {
		if(isset($this->pa['username']))
		{
			$username = $this->pa['username'];			
			$this->query();
			$sth = $this->prepare("SELECT id, username, password FROM users USE INDEX (content) WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth);			
			if($error !== TRUE)
			{
				$outURL = $this->getVal('url').'login&message='.urlencode($error);
				header('Location:'.$outURL);
				exit;
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				if($row['username'] == $username)
				{
					$msg = $this->getVal('url').'?username='.urlencode($row['username']).'&password='.urlencode($row['password']);			
					mail($username,'Password reset',$msg);
					$error = 'A link has been sent to your email address. Copy the link and paste it into the address bar of your web browser to reset your password.';
					$outURL = $this->getVal('url').'login&message='.urlencode($error);
					header('Location:'.$outURL);
					exit;			
				}
				else
				{
					$this->invalidEmail();
				}
			}
			else
			{
				$this->invalidEmail();
			}
		}
		else
		{
			$this->pleaseEnter();
		}
    }

    function register()
    {
    	$this->checkCaptcha();
    	$this->checkTerms();
    	
    	if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			$this->checkEmail();
			$this->checkPassword();
			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users USE INDEX (content) WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth);			
			if($error !== TRUE)
			{
				$outURL = $this->getVal('url').'login&message='.urlencode($error);
				header('Location:'.$outURL);
				exit;
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row === false) && ($sth->rowCount() == 0))
			{
				$sth = $this->prepare("INSERT INTO users (username,password) VALUES (:username,:password)");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$error = 'Registered. Please log-in';				
				$outURL = $this->getVal('url').'login&message='.urlencode($error);
				header('Location:'.$outURL);
				exit;
			}
			else
			{
				$this->alreadyExists();
			}
		}
		else
		{
			$this->pleaseEnter();
		}
    }

    function resetpassword()
    {
		if(isset($this->pa['username']) && isset($this->pa['password']))
		{
			$username = $this->pa['username'];
			$this->checkPassword();			
			$password = sha1(md5($this->pa['password']));			
			$sth = $this->prepare("SELECT id FROM users USE INDEX (content) WHERE username = :username");	
			$sth->bindParam(':username', $username);	
			$error = $this->testExecute($sth);			
			if($error !== TRUE)
			{
				$outURL = $this->getVal('url').'login&message='.urlencode($error);
				header('Location:'.$outURL);
				exit;
			}	
			$row = $sth->fetch(PDO::FETCH_ASSOC);		
			if(($row !== false) && ($sth->rowCount() > 0))
			{
				$sth = $this->prepare("UPDATE users SET password = :password WHERE username = :username");	
				$sth->bindParam(':username', $username);
				$sth->bindParam(':password', $password);	
				$sth->execute();
				$message = 'Password reset. Please log-in';
				$outURL = $this->getVal('url').'login&message='.urlencode($message);
				header('Location:'.$outURL);
				exit;
			}
			else
			{
				$this->alreadyExists();
			}
		}
		else
		{
			$this->pleaseEnter();
		}
    }

    function invalidEmail()
    {
    	$error = 'Invalid email. Please try again.';
		$outURL = $this->getVal('url').'login&message='.urlencode($error);
		header('Location:'.$outURL);
		exit;
    }

    function pleaseEnter()
    {
    	$error = 'Please enter an email and password to login.';
		$outURL = $this->getVal('url').'login&message='.urlencode($error);
		header('Location:'.$outURL);
		exit;
    }

    function alreadyExists()
    {
    	$error = 'Username already exists.';
		$outURL = $this->getVal('url').'login&message='.urlencode($error);
		header('Location:'.$outURL);
		exit;
    }

    function checkCaptcha()
    {
    	$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = 'secret=6LcWNyYTAAAAAIXS7i8L-6qskekmeyghQDJhbuFF';
		$data .= '&response='.$this->pa['g-recaptcha-response'];
		$data .='&remoteip'.$this->pa['remoteip'];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                
		$response = curl_exec($ch);
		$jsonResponse = json_decode($response, true);
		if($jsonResponse['success'] !== TRUE)
		{
			$error = 'Recaptcha not completed correctly';
    		$outURL = $this->getVal('url').'login&message='.urlencode($error);
			header('Location:'.$outURL);
			exit;
		}
    }

    function checkTerms()
    {
    	if($this->pa['termsaccepted'] != 'on')
    	{
    		$error = 'Terms of use not accepted';
    		$outURL = $this->getVal('url').'login&message='.urlencode($error);
			header('Location:'.$outURL);
			exit;
    	}
    }

    function checkEmail()
    {
    	if(filter_var($this->pa['username'], FILTER_VALIDATE_EMAIL))
		{
			$username = $this->pa['username'];
		}
		else
		{
			$error = 'Username must be a valid email address';
			$outURL = $this->getVal('url').'login&message='.urlencode($error);
			header('Location:'.$outURL);
			exit;
		}

		$pwdCheck = $this->checkPassword($this->pa['password']);
		if($pwdCheck !== FALSE)
		{
			$outURL = $this->getVal('url').'login&message='.urlencode($pwdCheck);
			header('Location:'.$outURL);
			exit;
		}
    }

    function checkPassword()
    {
	    $errors = array();
	    if(strlen($this->pa['password']) < 6)
	    {
	        array_push($errors, 'Password too short. ');
	    }

	    if(!preg_match("#[0-9]+#",$this->pa['password']))
	    {
	        array_push($errors, 'Password must include at least one number. ');
	    }

	    if(!preg_match("#[a-zA-Z]+#", $this->pa['password']))
	    {
	        array_push($errors, 'Password must include at least one letter.');
	    }
	    if(!empty($errors))
	    {
	    	$outURL = $this->getVal('url').'login&message='.urlencode(implode($errors));
			header('Location:'.$outURL);
			exit;
	    }
	}
}
?>