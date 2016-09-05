<?php
require_once 'database.class.php';
class tags extends database
{
	private $pa;
	function __construct($postArray = array())
	{
		parent::__construct();
		$this->pa = $postArray;
	}

	function addtag()
    {
    	$sth = $this->prepare("INSERT INTO tags (tag) VALUES (:tag)");
		$sth->bindParam(':tag', $this->pa['tag']);
		$message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'manager/tags',$message);
    }

    function updatetag()
    {
    	$sth = $this->prepare("UPDATE tags SET tag = :tag WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':tag', $this->pa['tag']);
		$message = $this->testExecute($sth, 'Record updated');
        $this->u->move_on($this->getVal('url').'manager/tags',$message);
    }

    function deletetags()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM tags WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/tags',$message);
    }

	function __destruct()
	{
		
	}
}
?>