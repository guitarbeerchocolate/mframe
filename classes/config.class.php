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
		$this->i = $sth->fetch(PDO::FETCH_ASSOC);
	}

	function __construct()
	{
		
	}
}
?>