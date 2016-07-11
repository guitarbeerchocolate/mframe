<?php
require_once 'database.class.php';
class config extends database
{
	public $i;
	function __construct()
	{
		parent::__construct();
		$sth = $this->prepare("SELECT * FROM config");
		$sth->execute();	
		$this->i = $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	function getVal($setting = NULL)
	{
		foreach ($this->i as $name => $index)
		{
			if(strtolower($setting) == strtolower($index['name']))
			{
				return $index['value'];
			}
		}
		return FALSE;
	}

	function getManagers()
	{
		return explode(',', $this->getVal('managerids'));
	}

	function __destruct()
	{
		
	}
}
?>