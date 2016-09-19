<?php
require_once 'database.class.php';
class contact extends database
{
	private $pa;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function send()
    {	
        $error = '';
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
            $this->u->move_on('contact',$error);
        }
        foreach ($this->getManagers() as $managerid)
        {
        	$user = $this->getOneByID('users',$managerid,'content');
            $message = 'From : '.$this->pa['emailaddress'].PHP_EOL.$this->pa['details'];
        	if(mail($user['username'],'Contact from website',$message))
            {
                $error = 'Your message has been sent.';
            }
            else
            {
                $error = 'Your mail not sent for unknown reasons.';
            }
        }
        $this->u->move_on($this->getVal('url'),$error);
    }
}
?>