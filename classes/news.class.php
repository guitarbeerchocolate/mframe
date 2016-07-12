<?php
require_once 'database.class.php';
require_once 'config.class.php';
class news extends database
{
	private $pa, $c;
    public $name, $content;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->c = new config;
    }

    function addnews()
    {
    	$sth = $this->prepare("INSERT INTO news (name,content) VALUES (:name,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$message = $this->testExcecute($sth, 'Record added');
        $outURL = $this->c->getVal('url').'manager/news&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function updatenews()
    {
    	$sth = $this->prepare("UPDATE news SET name = :name, content = :content WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
		$message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->c->getVal('url').'manager/news&message='.urlencode($message);
		header('Location:'.$outURL);
        exit;
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
        $outURL = $this->c->getVal('url').'manager/news&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function getnews($id)
    {
        $news = $this->getOneByID('news',$id);
        $this->name = $news['name'];        
        $this->content = $news['content'];
    }

    function __destruct()
    {

    }
}
?>