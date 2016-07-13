<?php
require_once 'database.class.php';
require_once 'config.class.php';
class pages extends database
{
	private $pa, $c;
    public $name, $content, $layout, $secondarycontent, $issubpage;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->c = new config;
    }

    function addpage()
    {
    	$sth = $this->prepare("INSERT INTO pages (name,content,layout,secondarycontent,issubpage) VALUES (:name,:content,:layout,:secondarycontent,:issubpage)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':layout', $this->pa['layout']);	
        $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
        $sth->bindParam(':issubpage', $this->pa['issubpage']);
		$message = $this->testExecute($sth, 'Record added');
		$this->u->move_on($this->c->getVal('url').'manager/pages',$message);
    }

    function updatepage()
    {
    	$sth = $this->prepare("UPDATE pages SET name = :name, content = :content, layout = :layout, secondarycontent = :secondarycontent, issubpage = :issubpage WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':layout', $this->pa['layout']);
        $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
        $sth->bindParam(':issubpage', $this->pa['issubpage']);	
		$message = $this->testExecute($sth, 'Record updated');
		$this->u->move_on($this->c->getVal('url').'manager/pages',$message);
    }

    function deletepages()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM pages WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $this->u->move_on($this->c->getVal('url').'manager/pages',$message);
    }    

    function getpage($id)
    {
        $page = $this->getOneByID('pages',$id);
        $this->name = $page['name'];        
        $this->content = $page['content'];
        $this->layout = $page['layout'];
        $this->secondarycontent = $page['secondarycontent'];
        $this->issubpage = $page['issubpage'];
    }

    function __destruct()
    {

    }
}
?>