<?php
require_once 'database.class.php';
require_once 'config.class.php';
class contact extends database
{
	private $pa, $c;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->c = new config;
    }

    function send()
    {	
        $error = '';
        foreach ($this->c->getManagers() as $managerid)
        {
            $user = $this->getOneByID('users',$managerid);
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
        $this->u->move_on($this->c->getVal('url'),$error);
    }
}
?>