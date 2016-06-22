<?php
require_once 'database.class.php';
require_once 'aggregator.class.php';
require_once 'utilities.class.php';
class externalfeeds extends database
{
	private $pa;
    public $name, $location, $agg, $u;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->agg = new aggregator;
        $this->u = new utilities;
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
		$outURL = $this->settings['website']['url'].'manager.php?inc=externalfeeds&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
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
		$outURL = $this->settings['website']['url'].'manager.php?inc=externalfeeds&message='.urlencode($message);
		header('Location:'.$outURL);
        exit;
    }

    function getResults()
    {
        $agg = new aggregator;
        $agg->setFeedLimit(10);
        $feeds = $this->listall('externalfeeds');
        foreach ($feeds as $feed)
        {
            switch($feed['type']) 
            {
                case 1:
                    $agg->addRSSFeed($feed['location']);
                    break;
                case 2:
                    $agg->addTwitterFeed($feed['location']);
                    break;
                case 3:
                    $agg->addTwitterHashtagFeed($feed['location']);
                    break;
                default:
                    # code...
                    break;
            }
        }
        $theFeed = $agg->getFeed();
        $errorArr = $agg->messageArr;
        if(count($errorArr) > 0)
        {
            $this->u->echoeol('<div class="row"><div class="container"><div id="message" class="col-md-12"><div class="alert alert-warning">');
            $this->u->echoeol('<h3>Errors</h3>');
            foreach ($errorArr as $err)
            {
                $this->u->echobr($err);
            }
            $this->u->echoeol('</div></div></div></div>');
        }        
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