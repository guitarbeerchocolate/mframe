<?php
require_once 'database.class.php';
require_once 'aggregator.class.php';
require_once 'config.class.php';
class externalfeeds extends database
{
	private $pa, $c;
    public $name, $location, $agg;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->agg = new aggregator;
        $this->c = new config;
    }

    function addexternalfeed()
    {
        $feedTest = simplexml_load_file($this->pa['location']);
        switch ($this->pa['type'])
        {
            case 1:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
            case 2:
                $feedTest = $this->agg->getTwitterUserJSON($this->pa['location']);
                break;
            case 3:
                $feedTest = $this->agg->getTwitterHashtagJSON($this->pa['location']);
                break;
            default:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
        }
        if(($feedTest == FALSE) || (isset($feedTest['errors'])))
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
		$this->u->move_on($this->c->getVal('url').'manager/externalfeeds',$message);
    }

    function updateexternalfeed()
    {
        $feedTest = simplexml_load_file($this->pa['location']);
        switch ($this->pa['type'])
        {
            case 1:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
            case 2:
                $feedTest = $this->agg->getTwitterUserJSON($this->pa['location']);
                break;
            case 3:
                $feedTest = $this->agg->getTwitterHashtagJSON($this->pa['location']);
                break;
            default:
                $feedTest = simplexml_load_file($this->pa['location']);
                break;
        }
        if(($feedTest == FALSE) || (isset($feedTest['errors'])))
        {
            $message = 'Invalid feed';
        }
        else
        {
        	$sth = $this->prepare("UPDATE externalfeeds SET name = :name, location = :location, type = :type WHERE id = :id");
        	$sth->bindParam(':id', $this->pa['id']);
    		$sth->bindParam(':name', $this->pa['name']);
    		$sth->bindParam(':location', $this->pa['location']);
            $sth->bindParam(':type', $this->pa['type']);	
    		$message = $this->testExcecute($sth, 'Record updated');
        }
		$this->u->move_on($this->c->getVal('url').'manager/externalfeeds',$message);
    }

    function getResults()
    {
        $feeds = $this->listall('externalfeeds');
        foreach ($feeds as $feed)
        {
            switch($feed['type']) 
            {
                case 1:
                    $this->agg->addRSSFeed($feed['location']);
                    break;
                case 2:
                    $this->agg->addTwitterFeed($feed['location']);
                    break;
                case 3:
                    $this->agg->addTwitterHashtagFeed($feed['location']);
                    break;
                default:
                    # code...
                    break;
            }
        }
        $theFeed = $this->agg->getFeed();
        return $theFeed;
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
        $this->u->move_on($this->c->getVal('url').'manager/externalfeeds',$message);
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