<?php
require_once 'database.class.php';
class news extends database
{
    private $pa;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addnews()
    {
    	$sth = $this->prepare("INSERT INTO news (name,content) VALUES (:name,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
		$message = $this->testExecute($sth, 'Record added');
        $this->u->move_on($this->getVal('url').'manager/news',$message);
    }

    function updatenews()
    {
    	$sth = $this->prepare("UPDATE news SET name = :name, content = :content WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
		$message = $this->testExecute($sth, 'Record updated');
		$this->u->move_on($this->getVal('url').'manager/news',$message);
    }

    function deletenews()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM news WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted';
        $this->u->move_on($this->getVal('url').'manager/news',$message);
    }

    function getdata($id)
    {
        return $this->getOneByID('news',$id,'content');
    }

    function __destruct()
    {

    }
}
?>