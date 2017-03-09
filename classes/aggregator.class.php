<?php
require_once 'database.class.php';
require_once 'twitterapiexchange.class.php';
date_default_timezone_set("Europe/London");
class aggregator extends database
{
	public $addr = NULL, $feedLimit, $messageArr, $tweeter;
	private $outArr = Array(), $twittersettings;
	function __construct($addr = NULL)
	{
		parent::__construct();
		$this->addr = $addr != NULL ? $addr : $this->addr;
		if($this->addr)
		{
			return $this->addRSSfeed();
		}
		$this->feedLimit = 10;
		$this->messageArr = array();
		$this->twittersettings = array('oauth_access_token'=>$this->getVal('twitter_oauth_access_token'),'oauth_access_token_secret'=>$this->getVal('twitter_oauth_access_token_secret'),'consumer_key'=>$this->getVal('twitter_consumer_key'),'consumer_secret'=>$this->getVal('twitter_consumer_secret'));
		$this->tweeter = new TwitterAPIExchange($this->twittersettings);
	}

	function setFeedLimit($l)
	{
		$this->feedLimit = $l;
	}

	function addRSSFeed($addr = NULL)
	{
		$this->addr = $addr != NULL ? $addr : $this->addr;
		$rss = simplexml_load_file($this->addr);
		$tempRSSobjArr = array();
		$rssObjArr = array();
		$entryCount = 0;
		if($rss == FALSE)
		{
			array_push($this->messageArr, 'Failed to load RSS feed '.$this->addr);
		}
		else
		{
			foreach($rss->channel->item as $entry)
			{
				if($entryCount < $this->feedLimit)
				{
					$tempRSSobjArr['title'] = '<i class="fa fa-rss-square" aria-hidden="true"></i> '.$entry->title;
					if((isset($entry->description)) && (isset($tempRSSobjArr['description'])))
					{
						$tempRSSobjArr['description'] .= $entry->description;
					}
					$tempRSSobjArr['link'] = $entry->link;
					$tempRSSobjArr['pubDate'] = $entry->pubDate;
					$to = (object) $tempRSSobjArr;
					unset($tempRSSobjArr);
					array_push($rssObjArr, $to);
					$entryCount++;
				}
			}
			$this->outArr = array_merge($this->outArr, $rssObjArr);
		}
	}

	function addTwitterFeed($tu = NULL)
	{
		$twitterjson = $this->getTwitterUserJSON($tu);
		$tempTwitterObjArr = array();
		$twitterObjArr = array();
		$entryCount = 0;
		if((empty($twitterjson)) || ($twitterjson == FALSE))
		{
			array_push($this->messageArr, 'Failed to load Twitter user feed '.$tu);
		}
		else
		{
			foreach($twitterjson as $item)
			{
				if($entryCount < $this->feedLimit)
				{
					$tempTwitterObjArr['description'] = '';
					$tempTwitterObjArr['title'] = '<i class="fa fa-twitter-square" aria-hidden="true"></i> Tweet by '.$item['user']['name'];
	 				if(isset($item['entities']['media'][0]['media_url']))
					{
						$tempTwitterObjArr['description'] .= '<img class="thumbnail pull-left" src="'.$item['entities']['media'][0]['media_url'].'" />';
					}
					$tempTwitterObjArr['description'] .= $this->turnIntoLinks($item['text']);
					$tempTwitterObjArr['link'] = 'http://twitter.com/'.$item['user']['screen_name'];
					$tempTwitterObjArr['pubDate'] = $item['created_at'];
					$to = (object) $tempTwitterObjArr;
					unset($tempTwitterObjArr);
				    array_push($twitterObjArr, $to);
				    $entryCount++;
				}
			}
			$this->outArr = array_merge($this->outArr, $twitterObjArr);
		}
	}

	function getTwitterUserJSON($tu)
	{
		$twitterurl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$twittergetfield = '?screen_name='.$tu.'&count=10';
		$twitterrequestMethod = 'GET';
		$decodedJSON = json_decode($this->tweeter->setGetfield($twittergetfield)->buildOauth($twitterurl, $twitterrequestMethod)->performRequest(),$assoc = TRUE);
		if((JSON_ERROR_NONE !== 0) || (isset($decodedJSON['errors'])))
		{
			return FALSE;
		}
		else
		{
			return $decodedJSON;
		}
	}

	function addTwitterHashtagFeed($ht = NULL)
	{
		$twitterjson = $this->getTwitterHashtagJSON($ht);
		$tempTwitterObjArr = array();
		$twitterObjArr = array();
		$entryCount = 0;
		if((empty($twitterjson['statuses'])) || ($twitterjson == FALSE))
		{
			array_push($this->messageArr, 'Failed to load Twitter hashtag feed '.$ht);
		}
		else
		{
			foreach($twitterjson['statuses'] as $item)
			{
				if($entryCount < $this->feedLimit)
				{
					$tempTwitterObjArr['description'] = '';
					$tempTwitterObjArr['title'] = '<i class="fa fa-twitter-square" aria-hidden="true"></i> Tweet by '.$item['user']['name'];
					if(isset($item['entities']['media'][0]['media_url']))
					{
						$tempTwitterObjArr['description'] .= '<img class="thumbnail pull-left" src="'.$item['entities']['media'][0]['media_url'].'" />';
					}
					$tempTwitterObjArr['description'] .= $this->turnIntoLinks($item['text']);
					$tempTwitterObjArr['link'] = 'http://twitter.com/'.$item['user']['screen_name'];
					$tempTwitterObjArr['pubDate'] = $item['created_at'];
					$to = (object) $tempTwitterObjArr;
					unset($tempTwitterObjArr);
				    array_push($twitterObjArr, $to);
				    $entryCount++;
				}
			}
			$this->outArr = array_merge($this->outArr, $twitterObjArr);
		}
	}

	function getTwitterHashtagJSON($ht)
	{
		$twitterurl = 'https://api.twitter.com/1.1/search/tweets.json';
		$twittergetfield = '?q=#'.$ht.'&result_type=recent&count=10';
		$twitterrequestMethod = 'GET';
		$decodedJSON = json_decode($this->tweeter->setGetfield($twittergetfield)->buildOauth($twitterurl, $twitterrequestMethod)->performRequest(),TRUE);
		if((JSON_ERROR_NONE !== 0) || (isset($decodedJSON['errors'])))
		{
			return FALSE;
		}
		else
		{
			return $decodedJSON;
		}
	}

	function addYouTubeFeed($un = NULL)
	{
		if(!is_null($un))
		{
			$tempYouTubeObjArr = array();
			$youTubeArr = array();
			$xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?user='.$un);
			$namespaces=$xml->getNameSpaces(true);
			array_unshift($namespaces,"");
			$entryCount = 0;
			foreach ($xml->entry as $entry)
			{
				if($entryCount < $this->feedLimit)
				{
					$tempYouTubeObjArr['title'] = '<i class="fa fa-youtube-square" aria-hidden="true"></i> '.$entry->title;
					$media = $entry->children('http://search.yahoo.com/mrss/');
					$index = 0;
					$thumbs = $media->group->thumbnail;
					foreach ($thumbs as $thumb)
					{
						$attrstring="";
	        			foreach ($namespaces as $ns)
	        			{
	                		foreach ($thumb->attributes($ns) as $attr => $value)
	                		{
	                			if($attr == 'url')
	                			{
	                				$tempYouTubeObjArr['description'] = '<img src="'.$value[0].'" class="thumbnail pull-left" />';
	                			}
	                        	$thumb_attrs[$index][$attr] = $value;
	                        	$attrstring.= $attr . ': ' . $thumb_attrs[$index][$attr] . "| ";
	                		}
	        			}
	        			$index++;
					}
					$tempYouTubeObjArr['description'] .= substr($media->group->description, 0,140).'...';
					$tempYouTubeObjArr['link'] = $entry->link['href'];
					$tempYouTubeObjArr['pubDate'] = $entry->published;
					$yto = (object) $tempYouTubeObjArr;
					unset($tempYouTubeObjArr);
				    array_push($youTubeArr, $yto);
				    $entryCount++;
				}
			}
			$this->outArr = array_merge($this->outArr, $youTubeArr);
		}

	}


	function addPinterestFeed($addr)
	{
		$this->addr = $addr != NULL ? $addr : $this->addr;
		$rss = simplexml_load_file('https://www.pinterest.com/'.$this->addr.'/feed.rss');
		$tempPinArr = array();
		$pinArr = array();
		$entryCount = 0;
		if($rss !== FALSE)
		{
			foreach ($rss->channel->item as $entry)
			{
				if($entryCount < $this->feedLimit)
				{
					$tempPinArr['title'] = '<i class="fa fa-pinterest-square" aria-hidden="true"></i> '.$entry->title;
					$tempPinArr['description'] = strip_tags($entry->description, '<p><img>');
					$tempPinArr['description'] = str_replace('<img ', '<img class="thumbnail pull-left" ', $tempPinArr['description']);
					$tempPinArr['link'] = $entry->link;
					$tempPinArr['pubDate'] = $entry->pubDate;
					$po = (object) $tempPinArr;
					unset($tempPinArr);
				    array_push($pinArr, $po);
				    $entryCount++;
				}
			}
			$this->outArr = array_merge($this->outArr, $pinArr);
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
	        if(0 === strpos($word, '#'))
	        {
	            $newString = '<a href="http://twitter.com/hashtag/'.ltrim($word,'#').'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	        elseif(0 === strpos($word, 'http'))
	        {
	            $newString = '<a href="'.$word.'" target="_blank">'.$word.'</a>';
	            $words[$key] = $newString;
	        }
	        elseif(0 === strpos($word, 'https'))
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