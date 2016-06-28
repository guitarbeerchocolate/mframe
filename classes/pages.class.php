<?php
require_once 'database.class.php';
class pages extends database
{
	private $pa;
    public $name, $content, $layout, $secondarycontent, $issubpage;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addpage()
    {
    	$sth = $this->prepare("INSERT INTO pages (name,content,layout,secondarycontent,issubpage) VALUES (:name,:content,:layout,:secondaryconten,:issubpaget)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':layout', $this->pa['layout']);	
        $sth->bindParam(':secondarycontent', $this->pa['secondarycontent']);
        $sth->bindParam(':issubpage', $this->pa['issubpage']);        
		$message = $this->testExcecute($sth, 'Record added');
		$outURL = $this->settings['website']['url'].'manager.php?inc=pages&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
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
		$message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->settings['website']['url'].'manager.php?inc=pages&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
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
        $outURL = $this->settings['website']['url'].'manager.php?inc=pages&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }    

    function getpage($id)
    {
        $page = $this->getOneByID('pages',$id);
        $this->name = $page['name'];        
        $this->content = $page['content'];
        $this->layout = $page['layout'];
    }

    function __destruct()
    {

    }
}
?>