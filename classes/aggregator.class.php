<?php
require_once('twitterapiexchange.class.php');
date_default_timezone_set("Europe/London");
class aggregator extends database
{
	public $addr = NULL;
	private $outArr = Array();
	private $twittersettings;
	public $feedLimit;
	public $messageArr;
	function __construct($addr = NULL)
	{
		$this->addr = $addr != NULL ? $addr : $this->addr;
		if($this->addr)
		{
			return $this->addRSSfeed();	
		}
		$this->feedLimit = 10;
		$this->messageArr = array();
		/* Initialise Twitter */
		$twitterRow = $this->getOneByID('twitter',1);

		$this->twittersettings = array('oauth_access_token'=>$twitterRow['oauth_access_token'],'oauth_access_token_secret'=>$twitterRow['oauth_access_token_secret'],'consumer_key'=>$twitterRow['consumer_key'],'consumer_secret'=>$twitterRow['consumer_secret']);
	}

	function setFeedLimit($l)
	{
		$this->feedLimit = $l;
	}

	function addRSSFeed($addr = NULL)
	{
		$this->addr = $addr != NULL ? $addr : $this->addr;
		$rss = simplexml_load_file($this->addr);
		if($rss !== FALSE)
		{
			$this->outArr = array_merge($this->outArr, $rss->xpath('/rss//item'));
		}
		else
		{
			array_push($this->messageArr, 'Failed to load RSS feed '.$this->addr);
		}		
	}

	function addTwitterFeed($tu = NULL)
	{
		$twitterurl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$twittergetfield = '?screen_name='.$tu.'&count=10';
		$twitterrequestMethod = 'GET';
		$tweeter = new TwitterAPIExchange($this->twittersettings);
		$twitterjson = json_decode($tweeter->setGetfield($twittergetfield)->buildOauth($twitterurl, $twitterrequestMethod)->performRequest(),$assoc = TRUE);
		$tempTwitterObjArr = array();
		$twitterObjArr = array();
		if(empty($twitterjson))
		{
			array_push($this->messageArr, 'Failed to load Twitter user feed '.$tu);
		}
		else
		{
			foreach($twitterjson as $item)
			{
				$tempTwitterObjArr['title'] = 'Tweet by '.$item['user']['name'];			
				$tempTwitterObjArr['description'] = $this->turnIntoLinks($item['text']);
				$tempTwitterObjArr['link'] = 'http://twitter.com/'.$item['user']['screen_name'];
				$tempTwitterObjArr['pubDate'] = $item['created_at'];
				$to = (object) $tempTwitterObjArr;
				unset($tempTwitterObjArr);
			    array_push($twitterObjArr, $to);		   
			}
			$this->outArr = array_merge($this->outArr, $twitterObjArr);
		}
	}

	function addTwitterHashtagFeed($ht = NULL)
	{
		$twitterurl = 'https://api.twitter.com/1.1/search/tweets.json';
		$twittergetfield = '?q=#'.$ht.'&result_type=recent&count=10';
		$twitterrequestMethod = 'GET';

		$tweeter = new TwitterAPIExchange($this->twittersettings);		
		$twitterjson = json_decode($tweeter->setGetfield($twittergetfield)->buildOauth($twitterurl, $twitterrequestMethod)->performRequest(),TRUE);
		$tempTwitterObjArr = array();
		$twitterObjArr = array();
		if(empty($twitterjson$twitterjson['statuses']))
		{
			array_push($this->messageArr, 'Failed to load Twitter hashtag feed '.$ht);
		}
		else
		{
			foreach ($twitterjson['statuses'] as $item)
			{
				$tempTwitterObjArr['title'] = 'Tweet by '.$item['user']['name'];			
				$tempTwitterObjArr['description'] = $this->turnIntoLinks($item['text']);
				$tempTwitterObjArr['link'] = 'http://twitter.com/'.$item['user']['screen_name'];
				$tempTwitterObjArr['pubDate'] = $item['created_at'];
				$to = (object) $tempTwitterObjArr;
				unset($tempTwitterObjArr);
			    array_push($twitterObjArr, $to);		   
			}
			$this->outArr = array_merge($this->outArr, $twitterObjArr);
		}
	}

	function addYouTubeFeed($url = NULL)
	{
		$json = file_get_contents($url);
		$data = json_decode($json);
		if($data == FALSE)
		{
			array_push($this->messageArr, 'Failed to load Twitter hashtag feed '.$url);
		}
		else
		{
			$json = file_get_contents($url);
			$data = json_decode($json);
			$items = $data->data->items;
			$tempYouTubeObjArr = array();
			$youTubeObjArr = array();

			foreach($items as $child)
			{
				$tempYouTubeObjArr['title'] = 'YouTube video : '.$child->title;			
				$tempYouTubeObjArr['description'] = $child->description;
				$tempYouTubeObjArr['link'] = $child->player->default;
				$tempYouTubeObjArr['pubDate'] = $child->updated;
				$to = (object) $tempYouTubeObjArr;
				unset($tempYouTubeObjArr);
			    array_push($youTubeObjArr, $to);
			}
			$this->outArr = array_merge($this->outArr, $youTubeObjArr);
		}
	}

	function getFeed($input = NULL)
	{
		usort($this->outArr, function ($x, $y)
		{
			if (strtotime($x->pubDate) == strtotime($y->pubDate)) return 0;
    		return (strtotime($x->pubDate) > strtotime($y->pubDate)) ? -1 : 1;
		});

		if(is_array($input))
		{
			$this->outArr = $this->getArrayFilteredFeed($input);
		}
		elseif(is_string($input))
		{
			$this->outArr = $this->getStringFilteredFeed($input);
		}
		return $this->outArr;
	}

	private function getStringFilteredFeed($s)
	{
		$tempArr = Array();
		foreach($this->outArr as $row)
		{
			if(stristr($row->title,$s) || stristr($row->description,$s))
			{
				array_push($tempArr, $row);
			}
		}
		return $tempArr;
	}

	private function getArrayFilteredFeed($arr)
	{
		$tempArr = Array();
		foreach($this->outArr as $row)
		{
			foreach ($arr as $key) 
			{
				if(stristr($row->title,$key) || stristr($row->description,$key))
				{
					array_push($tempArr, $row);
				}
			}
		}
		return $tempArr;
	}

	public function turnIntoLinks($s)
	{
	    $words = explode(' ', $s);
	    foreach($words  as $key => $word)
	    {
	        if(0 === strpos($word, '@'))
	        {
	            $newString = '<a href="http://twitter.com/'.ltrim($word,'@').'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	        elseif(0 === strpos($word, 'http'))
	        {
	            $newString = '<a href="'.$word.'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	    }
	    $res = implode(' ',$words);    
	    return $res;
	}

	public function getShorterDate($sDate)
	{
	    $expDate = explode(' ',$sDate);    
	    $retDate = $expDate[0].' '.$expDate[1].' '.$expDate[2].' ';
	    $justMinutes = explode(':',$expDate[3]);
	    $retDate .= $justMinutes[0].':'.$justMinutes[1];
	    return $retDate;
	}
}
?>