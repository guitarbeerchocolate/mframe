<?php
require_once 'database.class.php';
require_once 'utilities.class.php';
require_once 'config.class.php';
class profiles extends database
{
	private $pa, $c, $u;
    public $name, $content, $photo, $photolocation;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->photolocation = 'img/profile';
        $this->c = new config;
        $this->u = new utilities;
    }

    function addprofiles()
    {
        $message = 'Profile added';
        $uploadResult = '';
    	$sth = $this->prepare("INSERT INTO profiles (userid,name,content,photo) VALUES (:userid,:name,:content,:photo)");
        $sth->bindParam(':userid', $this->pa['userid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];            
            $uploadResult = $this->u->data_uri_string($filename, $mime);
        }
        $sth->bindParam(':photo', $uploadResult);
		$message = $this->testExcecute($sth, 'Record added');
		$outURL = $this->c->getVal('url').'private/&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function updateprofiles()
    {
    	$sth = $this->prepare("UPDATE profiles SET name = :name, content = :content, photo = :photo WHERE userid = :userid");
    	$sth->bindParam(':userid', $this->pa['userid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        if(isset($_FILES) && (!empty($_FILES['photo']['name'])))
        {
            $filename = $_FILES['photo']['tmp_name'];
            $mime = $_FILES['photo']['type'];            
            $uploadResult = $this->u->data_uri_string($filename, $mime);
        }
        else
        {
            $uploadResult = $this->pa['tempphoto'];
        }
		$sth->bindParam(':photo', $uploadResult);
        $message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->c->getVal('url').'private/&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function deleteprofiles()
    {
        foreach ($this->pa['id'] as $checked)
        {
            $sth = $this->prepare("DELETE FROM profiles WHERE id = :id");
            $sth->bindParam(':id', $checked);
            $sth->execute();
        }
        $message = 'Records deleted ';
        $outURL = $this->c->getVal('url').'manager/profiles&message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function getprofiles($id)
    {
        $profiles = $this->getOneByID('profiles',$id);
        $this->name = $profiles['name'];        
        $this->content = $profiles['content'];
    }

    function __destruct()
    {

    }
}
?>