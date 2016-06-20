<?php
require_once 'database.class.php';
class externalfeeds extends database
{
	private $pa;
    public $name, $location;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
    }

    function addexternalfeed()
    {
        $feedTest = simplexml_load_file($this->pa['location']);
        switch ($this->pa['location'])
        {
            case 1:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
            case 2:
                $feedTest = json_decode(file_get_contents($this->pa['location']));
                break;
            case 3:
                $feedTest = json_decode(file_get_contents($this->pa['location']));
                break;
            case 4:
                $feedTest = json_decode(file_get_contents($this->pa['location']));
                break;
            default:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
        }
        if($feedTest == FALSE)
        {
            $message = 'Invalid feed';
        }
        else
        {
            $sth = $this->prepare("INSERT INTO externalfeeds (name,location,type) VALUES (:name,:location,:type)");
            $sth->bindParam(':name', $this->pa['name']);
            $sth->bindParam(':location', $this->pa['location']);
            $sth->bindParam(':type', $this->pa['type']);
            $message = $this->testExcecute($sth, 'Record added');
        }
		$outURL = $this->settings['website']['url'].'manager.php?inc=externalfeeds&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function updateexternalfeeds()
    {
    	$sth = $this->prepare("UPDATE externalfeeds SET name = :name, location = :location, type = :type WHERE id = :id");
    	$sth->bindParam(':id', $this->pa['id']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':location', $this->pa['location']);
        $sth->bindParam(':type', $this->pa['type']);	
		$message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->settings['website']['url'].'manager.php?inc=externalfeeds&message='.urlencode($message);
		header('Location:'.$outURL);
        exit;
    }

    function deleteexternalfeeds()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM externalfeeds WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }        
        $message = 'Records deleted';
        $outURL = $this->settings['website']['url'].'manager.php?inc=externalfeeds&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function getexternalfeed($id)
    {
        $externalfeeds = $this->getOneByID('externalfeeds',$id);
        $this->name = $externalfeeds['name'];        
        $this->location = $externalfeeds['location'];
    }

    function __destruct()
    {

    }
}
?>