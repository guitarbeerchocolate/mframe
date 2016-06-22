<?php
require_once 'database.class.php';
require_once 'fileupload.class.php';
class profiles extends database
{
	private $pa;
    public $name, $content, $photo, $photolocation;
    public function __construct($postArray = array())
    {
        parent::__construct();
        $this->pa = $postArray;
        $this->photolocation = 'img/profile';
    }

    function addprofiles()
    {
        $message = 'Profile added';
        $uploadResult = '';
    	$sth = $this->prepare("INSERT INTO profiles (userid,name,content,photo) VALUES (:userid,:name,:content,:photo)");
        $sth->bindParam(':userid', $this->pa['userid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);
        if(!empty($_FILES) && isset($_FILES['photo']))
        {
            $this->files = (object) $_FILES['photo'];
        }        
        
        if(!empty($this->files->name))
        {
            $fu = new fileupload($this->photolocation);
            $fu->files = $this->files;
            $uploadResult = $fu->imageupload($this->pa['userid'],200,300);
        }
        $sth->bindParam(':photo', $uploadResult);
		$message = $this->testExcecute($sth, 'Record added');
		$outURL = $this->settings['website']['url'].'private.php?message='.urlencode($message);
        header('Location:'.$outURL);
        exit;
    }

    function updateprofiles()
    {
    	$sth = $this->prepare("UPDATE profiles SET name = :name, content = :content, photo = :photo WHERE userid = :userid");
    	$sth->bindParam(':userid', $this->pa['userid']);
		$sth->bindParam(':name', $this->pa['name']);
		$sth->bindParam(':content', $this->pa['content']);

        if(!empty($_FILES) && isset($_FILES['photo']))
        {
            $this->files = (object) $_FILES['photo'];
            if(!empty($this->files->name))
            {
                $fu = new fileupload($this->photolocation);
                $fu->files = $this->files;
                $uploadResult = $fu->imageupload($this->pa['userid'],200,300);
            }
            else
            {
                $uploadResult = $this->pa['tempphoto'];
            }
            $sth->bindParam(':photo', $uploadResult);
        }
        else
        {
             $sth->bindParam(':photo', $this->pa['tempphoto']);
        }	
		
        $message = $this->testExcecute($sth, 'Record updated');
		$outURL = $this->settings['website']['url'].'private.php?message='.urlencode($message);
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
        $outURL = $this->settings['website']['url'].'manager.php?inc=profiles&message='.urlencode($message);
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