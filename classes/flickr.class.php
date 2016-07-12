<?php
require_once 'config.class.php';
class flickr
{
	private $flickr_key, $flickr_secret, $format = 'json', $c;
	public $settings;
	/* How to use:
	$f = new flickr;
	$photoset = $f->getphotoset('72157637918564954');
	foreach ($photoset as $photo)
	{
		echo $photo['farm'].'<br />';
		$url = 'https://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_b.jpg';
		echo '<img src="'.$url.'" />';
	}
	*/
	function __construct()
	{
		$this->c = new config;
		$this->flickr_key = $this->c->getVal('flickr_api_key');
		$this->flickr_secret = $this->c->getVal('flickr_api_secret');
	}

	function getphotoset($ps = NULL)
	{
		$urlencoded_tags = array();
  
		if(!empty($tags))
		{    
		  $tags_r = explode(',', $tags);
		  foreach($tags_r as $tag)
		  {
		      $urlencoded_tags[] = urlencode($tag);
		  }
		}

		$url  = 'https://api.flickr.com/services/rest/?';
		$url .= 'method=flickr.photosets.getPhotos';		
		$url .= '&api_key='.$this->flickr_key;
		$url .= '&photoset_id='.$ps;
		$url .= '&format=' . $this->format;

		$result = file_get_contents($url);

		$json = substr($result, strlen("jsonFlickrApi("), strlen($result) - strlen("jsonFlickrApi(") - 1);

		$photos = array();
		$data = json_decode($json, true);
		
		if($data['stat'] != 'fail')
		{
		  $photos = $data['photoset']['photo'];
		  return $photos;
		}
		else
		{
		  return false;
		}		
	}

	function __destruct()
	{
		
	}
}
?>