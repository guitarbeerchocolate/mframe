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
    	$manageridArr = explode(',',$this->settings['website']['managerids']);
        $error = 'A message has been sent.';
        foreach ($manageridArr as $managerid)
        {
        	$user = $this->getOneByID('users',$managerid);
        	mail($user['username'],'Contact from website',$this->pa['details']);
        }
        return $error;
    }
}
?>