<?php
require_once 'database.class.php';
class config extends database
{
	private $pa;
	public $i;
	function __construct($postArray = array())
	{
		parent::__construct();
		$this->pa = $postArray;
		$sth = $this->prepare("SELECT * FROM config");
		$error = $this->testExecute($sth, 'Records received');			
		if($error !== 'Records received')
		{
			$this->u->move_on('index.php',$error);
		}
		$this->i = $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	function additem()
    {
    	$sth = $this->prepare("INSERT INTO config (name,value) VALUES (:name,:value)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':value', $this->pa['value']);	
		$message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'manager/config',$message);
    }

    function updateitem()
    {
    	$sth = $this->prepare("UPDATE config SET name = :name, value = :value WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':value', $this->pa['value']);		
		$message = $this->testExecute($sth, 'Record updated');		
		$this->u->move_on($this->getVal('url').'manager/config',$message);
    }

    function deleteitems()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM config WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/config',$message);
    }

	function __destruct()
	{
		
	}
}
?>