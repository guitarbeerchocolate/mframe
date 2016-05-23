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
		$sth->execute();
        $message = 'Record added';
		$outURL = $this->settings['website']['url'].'manager.php?inc=manageevents&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
    }

    function updateevents()
    {
    	$sth = $this->prepare("UPDATE events SET name = :name, content = :content, datestart = :datestart, dateend = :dateend WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        $sth->bindParam(':datestart', $this->pa['datestart']);
        $sth->bindParam(':dateend', $this->pa['dateend']);
		$sth->execute();
        $message = 'Record updated';
		$outURL = $this->settings['website']['url'].'manager.php?inc=manageevents&message='.$message;
		$myArr = array('location'=>$outURL);
		return $myArr;
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
        $outURL = $this->settings['website']['url'].'manager.php?inc=manageevents&message='.$message;
        $myArr = array('location'=>$outURL);
        return $myArr;
    }

    function addeventsimage()
    {
        $target_dir = 'data/events/'.$this->pa['id'];
        if(!file_exists($target_dir))
        {
            mkdir($target_dir, 0777, true);
        }
        $target_dir .= '/';        
        $target_file = $target_dir.basename($_FILES["eventsfile"]["name"]);
        $tmp_name = $_FILES["eventsfile"]["tmp_name"];        
        move_uploaded_file($tmp_name, $target_file);
        $outURL = $target_file;
        $myArr = array('location'=>$outURL);
        return $myArr;
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