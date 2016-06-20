<?php
require_once 'database.class.php';
class events extends database
{
	private $pa;
    public $name, $content, $datestart, $dateend;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addevents()
    {
    	$sth = $this->prepare("INSERT INTO events (name,datestart,dateend,content) VALUES (:name,:datestart,:dateend,:content)");
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);	
        $sth->bindParam(':datestart', $this->pa['datestart']);
        $sth->bindParam(':dateend', $this->pa['dateend']);
        $message = $this->testExcecute($sth, 'Record added');		
		$outURL = $this->settings['website']['url'].'manager.php?inc=events&message='.urlencode($message);
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
		$outURL = $this->settings['website']['url'].'manager.php?inc=events&message='.urlencode($message);
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
        $outURL = $this->settings['website']['url'].'manager.php?inc=events&message='.urlencode($message);
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