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
        $error = 'A message has been sent.';
        foreach ($this->c->getManagers() as $managerid)
        {
        	$user = $this->getOneByID('users',$managerid);
        	mail($user['username'],'Contact from website',$this->pa['details']);
        }
        return $error;
    }
}
?>