<?php
require_once 'database.class.php';
require_once 'config.class.php';
class events extends database
{
	private $pa, $c;
    public $name, $content, $datestart, $dateend;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->c = new config;
    }

    function addevents()
    {
    	$sth = $this->prepare("INSERT INTO events (name,datestart,dateend,content) VALUES (:name,:datestart,:dateend,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
        $sth->bindParam(':datestart', $this->pa['datestart']);
        $sth->bindParam(':dateend', $this->pa['dateend']);
        $outURL = $this->c->getVal('url').'manager/events&message='.urlencode($message);
		header('Location:'.$outURL);
        exit;
    }

    function updateevents()
    {
    	$sth = $this->prepare("UPDATE events SET name = :name, content = :content, datestart = :datestart, dateend = :dateend WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':datestart', $this->pa['datestart']);
        $sth->bindParam(':dateend', $this->pa['dateend']);
		$message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->c->getVal('url').'manager/events&message='.urlencode($message);
		header('Location:'.$outURL);
        exit;
    }

    function deleteevents()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM events WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->c->getVal('url').'manager/events&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function getevents($id)
    {
        $events = $this->getOneByID('events',$id);
        $this->name = $events['name'];        
        $this->content = $events['content'];
        $this->datestart = $events['datestart'];        
        $this->dateend = $events['dateend'];
    }

    function listevents()
    {
        $sql = "SELECT * FROM events ORDER BY datestart ASC"; 
        $stmt = $this->query($sql); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function __destruct()
    {

    }
}
?>